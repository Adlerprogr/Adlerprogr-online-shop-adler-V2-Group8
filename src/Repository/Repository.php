<?php

namespace Repository;

use PDO;

class Repository
{
    protected static PDO $pdo;

    public static function getPdo(): PDO
    {
        if (isset(self::$pdo)) {
            return self::$pdo;
        }

        return self::$pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");
    }
}