<?php

namespace Src\Models;

use Core\Model;
use \PDO;

class LoginModel extends Model 
{

    public function __construct()
    {
        parent::__construct();
    }

    public function logInEmployee(array $dataFromLoginForm)
    {                                 
        $query = "SELECT * FROM employees WHERE fullname = :fullname";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':fullname' => $dataFromLoginForm['fullname']
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}