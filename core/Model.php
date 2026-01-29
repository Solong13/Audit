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

    public function countAll(string $table): int
    {
        return (int)$this->db
            ->query("SELECT COUNT(*) FROM {$table}")
            ->fetchColumn();
    }

    public function findPaginated(int $limit, int $offset, string $table, string $orderBy = 'DESC'): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$table}
            ORDER BY {$orderBy}
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}