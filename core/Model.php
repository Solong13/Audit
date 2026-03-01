<?php

namespace Core;

class Model 
{
    public \PDO $db;

    public function __construct()
    {
        $dsn = "mysql:host={$_ENV['APP_HOST']};dbname=Audit;charset=utf8";
        $user = "{$_ENV['APP_USER']}";
        $pass = "{$_ENV['APP_PASS']}";

        $this->db = new \PDO($dsn, $user, $pass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ]);
    }
}