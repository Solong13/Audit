<?php

namespace Core;

use PDO;

class Database 
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getConection() : PDO
    {
        return $this->pdo;
    }
}