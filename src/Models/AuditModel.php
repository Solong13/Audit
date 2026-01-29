<?php

class Audit
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function countAll(): int
    {
        return (int) $this->db
            ->query("SELECT COUNT(*) FROM audit")
            ->fetchColumn();
    }

    public function getPaginated(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM audit
             ORDER BY date DESC
             LIMIT :limit OFFSET :offset"
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
