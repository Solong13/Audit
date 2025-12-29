<?php

namespace Src\Models;

use Core\Model;
use \PDO;

class EmployeeModel extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCurrentEmployee( $id_employee): array
    {
        $query = "SELECT * FROM employees AS e
        JOIN salaries AS s ON e.id_employee = s.id_employee
        JOIN positions AS p ON e.id_position = p.id_position
        WHERE e.id_employee = :id_employee";

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                ':id_employee' => $id_employee
            ]
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployee($id_employee)
    {
        $query = "SELECT * FROM employees AS e 
        INNER JOIN positions as p ON e.id_position = p.id_position 
        WHERE e.id_employee = :id_employee";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_employee' => $id_employee
        ]);
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) < 5) {
            return $result[0];
        }
        return $result;
    }

    public function countRow($id_employee) 
    {
        $query = "SELECT COUNT(*) FROM salaries WHERE id_employee = :id_employee";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_employee' => $id_employee
        ]);
        
        return (int)$stmt->fetchColumn();
    }
}