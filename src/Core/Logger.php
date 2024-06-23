<?php

namespace Core;

class Logger implements LoggerInterface
{
    #[\Override] public function emergency($message, array $context = array()): void
    {
        // TODO: Implement emergency() method.
    }

    #[\Override] public function alert($message, array $context = array()): void
    {
        // TODO: Implement alert() method.
    }

    #[\Override] public function critical($message, array $context = array()): void
    {
        // TODO: Implement critical() method.
    }

    #[\Override] public function error($message, array $context = array()): void
    {
        $date = date('Y/m/d H:i:s');
        $context = implode("\n", $context);
        $message = $message . "\n" . 'date: ' . $date . "\n" . $context;
        file_put_contents(dirname(__DIR__) . '/Storage/Logs/errors.txt', $message . "\n\n", FILE_APPEND);
    }

    #[\Override] public function warning($message, array $context = array()): void
    {
        // TODO: Implement warning() method.
    }

    #[\Override] public function notice($message, array $context = array()): void
    {
        // TODO: Implement notice() method.
    }

    #[\Override] public function info($message, array $context = array()): void
    {
        // TODO: Implement info() method.
    }

    #[\Override] public function debug($message, array $context = array()): void
    {
        // TODO: Implement debug() method.
    }

    #[\Override] public function log($level, $message, array $context = array()): void
    {
        // TODO: Implement log() method.
    }
}