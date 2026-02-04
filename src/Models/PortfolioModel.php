<?php

namespace Src\Models;

use Core\Model;
use \PDO;
use Src\Interfaces\RepositoryInterface;

class PortfolioModel extends Model implements RepositoryInterface
{
    protected string $table = 'salaries';

    public function __construct()
    {
        parent::__construct();
    }

    public function countAll(string $table): int 
    {
        return (int)$this->db
            ->query("SELECT COUNT(*) FROM {$table}")
            ->fetchColumn();
    }

    public function countAllById(string $table, int|string $id): int 
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$table} WHERE id_employee = :id");
        $stmt->execute(['id' => $id]);
        return (int)$stmt->fetchColumn();
    }

    public function findPaginated(int $limit, int $offset, string $table, string $orderBy): array 
    {
        $stmt = $this->db->prepare("
            SELECT * FROM positions p
            INNER JOIN employees as e ON p.id_position = e.id_position
            ORDER BY id_employee {$orderBy}
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findPaginatedById(int $limit, int $offset, string $table, int|string $id, string $orderBy): array 
    {
        $stmt = $this->db->prepare("
            SELECT * FROM salaries AS s 
            INNER JOIN employees as e ON s.id_employee = e.id_employee 
            INNER JOIN positions as p ON e.id_position = p.id_position
            WHERE e.id_employee = :id_employee
            ORDER BY s.id_employee {$orderBy}
            LIMIT :limit OFFSET :offset 
        ");
        
        $stmt->bindValue(':id_employee', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }





    // function getAllEmployeeAndTheirPositions(): array
    // {
    //     $query = "SELECT * FROM positions p
    //     INNER JOIN employees e ON p.id_position = e.id_position LIMIT 5";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    // function getSalaryCurrentEmployee(int $idEmployee) : array
    // {
    //     $query = "SELECT * FROM salaries AS s 
    //     INNER JOIN employees as e ON s.id_employee = e.id_employee 
    //     INNER JOIN positions as p ON e.id_position = p.id_position 
    //     WHERE e.id_employee = :id_employee";
        
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute([
    //         ':id_employee' => $idEmployee
    //     ]);
        
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     return $result;
    // }
    // function getCurrentPosition(int|string $id_position): array
    // {
    //     $query = "SELECT base_salary FROM positions
    //     WHERE id_position = :id_position";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute([
    //         ':id_position' => (int)$id_position
    //     ]);
    //     $result = $stmt->fetch();
    //     return $result;
    // }
}