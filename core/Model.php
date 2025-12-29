<?php

namespace Core;

class Model 
{
    /*
    Вона матиме тип \PDO — це PHP-клас, який використовується для роботи з базами даних.
    \ перед PDO означає, що береться глобальний клас PDO, а не з простору імен.
    */
    public \PDO $db;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=Audit;charset=utf8";
        $user = "root";
        $pass = "";

        $this->db = new \PDO($dsn, $user, $pass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // <-- Головне
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ]);
    }
}