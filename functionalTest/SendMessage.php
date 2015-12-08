<?php
require_once __DIR__ . '/../src/AuditLogMessage.php';
require_once __DIR__ . '/../vendor/autoload.php';
use Canddi\LogMessage\AuditLogMessage;

$message = new AuditLogMessage('AKIAI4VVYWW7D5BU7VDA', 'Ry6zihItejf/fG7RvcCdY/oRg1S6Ri2L+HlkKpl2', 'eu-west-1', 'arn:aws:sns:eu-west-1:193028867555:AuditLog');

$message->sendMessage(
    'idktest',
    'some admin',
    'phpapp',
    'index',
    '{"key":"value"}'
);
