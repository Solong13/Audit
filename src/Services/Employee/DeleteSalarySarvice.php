<?php

namespace Src\Services\Employee;

use Src\Models\EmployeeModel;

class DeleteSalarySarvice
{
    private EmployeeModel $employeeModel; 

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function deleteSalary(int $id_salary) 
    {
        $this->employeeModel->deleteOneSalary($id_salary);
        // Щоб повернутися до поточного користувача можна написати ще один SQL до БД
    }
}