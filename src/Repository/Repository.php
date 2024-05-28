<?php

namespace Repository;

use PDO;

class Repository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=db; port=5432; dbname=laravel", "root", "root");
    }
}