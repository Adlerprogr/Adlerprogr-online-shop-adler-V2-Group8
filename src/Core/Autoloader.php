<?php

namespace Core;

class Autoloader
{
    public static function registration(string $dir):void
    {
        $autoloader = function (string $className) use ($dir) {
            $helper = str_replace('\\', DIRECTORY_SEPARATOR, $className);
            $path = $dir . '/' . $helper . '.php';
            if (file_exists($path)) {
                require_once $path;
                return true;
            } else {
                return false;
            }
        };

        spl_autoload_register($autoloader);
    }
}