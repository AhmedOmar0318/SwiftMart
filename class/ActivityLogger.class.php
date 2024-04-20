<?php

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class ActivityLogger extends AbstractProcessingHandler
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function write(LogRecord $record): void
    {
        $insertLogs = $this->conn->prepare("INSERT INTO activitylog(channel,level,message,time) VALUES (:channel,:level,:message,:time)");
        $insertLogs->execute(array(
            ':channel' => $record->channel,
            ':level' => $record->level->getName(),
            ':message' => $record->message,
            ':time' => $record->datetime
        ));
    }
} ?>