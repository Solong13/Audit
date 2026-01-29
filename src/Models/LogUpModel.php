<?php

namespace Src\Models;

use Core\Model;
use \PDO;

class LogUpModel extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    function getPosition(): array
    {
        $query = "SELECT * FROM positions";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getPositionId(string $position_name): array
    {
        $query = "SELECT id_position FROM positions WHERE position_name = :position_name";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':position_name' => $position_name
        ]);
        $result = $stmt->fetch();
        return $result;
    }

    function createEmployee(array $data)
    {
        $query = "INSERT INTO employees 
        (id_position, fullname, password, table_number, workshop, work_experience, photo, employee_role)
        VALUES
        (:id_position, :fullname, :password, :table_number, :workshop, :work_experience, :photo, :employee_role)";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'id_position' => $data['id_position'],
            'fullname' => $data['fullname'],
            'password' => $data['password'],
            'table_number' => $data['table_number'],
            'workshop' => $data['workshop'],
            'work_experience' => $data['work_experience'] ?? 0,
            'photo' => $data['photo'] ?? null,
            'employee_role' => $data['employee_role']  ?? 0,
        ]);
    }
}