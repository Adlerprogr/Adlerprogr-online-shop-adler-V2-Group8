<?php

namespace Core;

class Logger
{
    public function error($message, array $context = array()): void
    {
        $date = date('Y/m/d H:i:s');
        $context = implode("\n", $context);
        $message = $message . "\n" . 'date: ' . $date . "\n" . $context;
        file_put_contents(dirname(__DIR__) . '/Storage/Logs/errors.txt', $message . "\n\n", FILE_APPEND);
    }
}