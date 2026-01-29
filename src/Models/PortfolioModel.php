<?php

namespace Src\Models;

use Core\Model;
use \PDO;

class PortfolioModel extends Model 
{
    protected string $table = 'salaries';

    public function __construct()
    {
        parent::__construct();
    }

    public function countAllRep($table)
    {
        return parent::countAll($table);
    }

    public function findPaginatedRep(int $limit, int $offset, string $table, string $orderBy = 'id DESC')
    {
        return parent::findPaginated($limit, $offset, $table, $orderBy);
    }


    function getAllEmployeeAndTheirPositions(): array
    {
        $query = "SELECT * FROM positions p
        INNER JOIN employees e ON p.id_position = e.id_position LIMIT 5";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getSalaryCurrentEmployee(int $idEmployee) : array
    {
        $query = "SELECT * FROM salaries AS s 
        INNER JOIN employees as e ON s.id_employee = e.id_employee 
        INNER JOIN positions as p ON e.id_position = p.id_position 
        WHERE e.id_employee = :id_employee";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_employee' => $idEmployee
        ]);
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    function getCurrentPosition(int|string $id_position): array
    {
        $query = "SELECT base_salary FROM positions
        WHERE id_position = :id_position";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_position' => (int)$id_position
        ]);
        $result = $stmt->fetch();
        return $result;
    }
}