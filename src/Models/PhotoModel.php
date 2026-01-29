<?php

namespace Src\Models;

use Core\Model;
use \PDO;

class PhotoModel extends Model 
{
    public function __construct()
    {
        parent::__construct();
    }

    function addPhotoEmployee(string $photoPath, int|string $id_employee) : void
    {
        $query = "UPDATE employees SET photo = :photo WHERE id_employee = :id_employee;";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_employee' => (int)$id_employee,
            ':photo' => $photoPath
        ]);
    }
}