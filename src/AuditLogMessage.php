<?php
namespace Canddi\LogMessage;
use Aws\Sns\SnsClient;

/**
 * Class AuditLogMessage
 * @package Canddi\LogMessage
 */
class AuditLogMessage
{
    /**
     * @var array
     */
    private $_arrCredentials = [];

    /**
     * @var string
     */
    private $_strTarget = '';

    /**
     * AuditLogMessage constructor.
     * @param $strKey
     * @param $strSecret
     * @param $strRegion
     * @param $strTarget
     * @throws \Exception (On missing parameters)
     */
    public function __construct($strKey, $strSecret, $strRegion, $strTarget) {
        if(empty($strKey)) {
            throw new \Exception('Authentication Key Missing');
        }
        if(empty($strSecret)) {
            throw new \Exception('Authentication Secret Missing');
        }
        if(empty($strRegion)) {
            throw new \Exception('Topic Region Missing');
        }
        if(empty($strTarget)) {
            throw new \Exception('Topic Target Missing');
        }

        $this->_arrCredentials = [
            'credentials' => [
                'key'    => $strKey,
                'secret' => $strSecret,
            ],
            'region' => $strRegion
        ];

        $this->_strTarget = $strTarget;
    }

    /**
     * @param $strAccountUrl
     * @param $strUserId
     * @param $strApplication
     * @param $strEndpoint
     * @param $arrJsonData
     * @throws \Exception (on missing parameters)
     * @throws Aws\Sns\Exception\SnsException (on method failure)
     */
    public function sendMessage($strAccountUrl, $strUserId, $strApplication, $strEndpoint, $arrJsonData) {
        if(empty($strAccountUrl)) {
            throw new \Exception('Missing Account URL');
        }
        if(empty($strUserId)) {
            throw new \Exception('Missing User ID');
        }
        if(empty($strApplication)) {
            throw new \Exception('Missing Application Name');
        }
        if(empty($strEndpoint)) {
            throw new \Exception('Missing URL Endpoint');
        }

        $strTarget = $this->_strTarget;
        $arrMessage = [
            'accounturl'  => $strAccountUrl,
            'userid'      => $strUserId,
            'application' => $strApplication,
            'endpoint'    => $strEndpoint
        ];

        if(isset($arrJsonData)) {
            $arrJsonData = is_array($arrJsonData) ? json_encode($arrJsonData) : $arrJsonData;
            $arrMessage['json_data'] = $arrJsonData;
        }

        $client = SnsClient::factory($this->_arrCredentials);

        $arrMessage = json_encode([
            'default' => json_encode($arrMessage),
            'lambda'  => json_encode($arrMessage)
        ]);

        $client->publish([
            'TargetArn'        => $strTarget,
            'MessageStructure' => 'json',
            'Message'          => $arrMessage
        ]);
    }
}
