<?php
require_once __DIR__ . '/../src/AuditLogMessage.php';
require_once __DIR__ . '/../vendor/autoload.php';
use Canddi\LogMessage\AuditLogMessage;

class AuditLogMessageTest extends PHPUnit_Framework_TestCase {
    public function testConstructorMissingFirstParameter() {
        $this->setExpectedException('\Exception', 'Authentication Key Missing');
        new AuditLogMessage(
            '',
            'word',
            'word',
            'word'
        );
    }

    public function testConstructorMissingSecondParameter() {
        $this->setExpectedException('\Exception', 'Authentication Secret Missing');
        new AuditLogMessage(
            'word',
            '',
            'word',
            'word'
        );
    }

    public function testConstructorMissingThirdParameter() {
        $this->setExpectedException('\Exception', 'Topic Region Missing');
        new AuditLogMessage(
            'word',
            'word',
            '',
            'word'
        );
    }

    public function testConstructorMissingFourthParameter() {
        $this->setExpectedException('\Exception', 'Topic Target Missing');
        new AuditLogMessage(
            'word',
            'word',
            'word',
            ''
        );
    }

    public function testSendMessageMissingFirstParameter() {
        $this->setExpectedException('\Exception', 'Missing Account URL');
        $classAuditLogMessage = new AuditLogMessage(
            'word',
            'word',
            'word',
            'word'
        );

        $classAuditLogMessage->sendMessage(
            '',
            'word',
            'word',
            'word',
            ''
        );
    }

    public function testSendMessageMissingSecondParameter() {
        $this->setExpectedException('\Exception', 'Missing User ID');
        $classAuditLogMessage = new AuditLogMessage(
            'word',
            'word',
            'word',
            'word'
        );

        $classAuditLogMessage->sendMessage(
            'word',
            '',
            'word',
            'word',
            ''
        );
    }

    public function testSendMessageMissingThirdParameter() {
        $this->setExpectedException('\Exception', 'Missing Application Name');
        $classAuditLogMessage = new AuditLogMessage(
            'word',
            'word',
            'word',
            'word'
        );

        $classAuditLogMessage->sendMessage(
            'word',
            'word',
            '',
            'word',
            ''
        );
    }

    public function testSendMessageMissingFourthParameter() {
        $this->setExpectedException('\Exception', 'Missing URL Endpoint');
        $classAuditLogMessage = new AuditLogMessage(
            'word',
            'word',
            'word',
            'word'
        );

        $classAuditLogMessage->sendMessage(
            'word',
            'word',
            'word',
            '',
            ''
        );
    }
};
