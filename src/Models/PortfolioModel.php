<?php

namespace Src\Models;

use Core\Model;
use \PDO;

class PortfolioModel extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    function getAllEmployeeAndTheirPositions(): array
    {
        $query = "SELECT *
        FROM positions p
        INNER JOIN employees e ON p.id_position = e.id_position";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getSalaryCurrentEmployee(int $idEmployee) : array
    {
        $query = "SELECT * FROM salaries AS s 
        INNER JOIN employees as e ON s.id_employee = e.id_employee 
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