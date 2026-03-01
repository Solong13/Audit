<?php

namespace Src\Services\Employee;

use Src\Models\EmployeeModel;

class EditSalaryService 
{
    private EmployeeModel $employeeModel; 

    public function __construct()
    {   
        $this->employeeModel = new EmployeeModel();
    }

    public function editSalary(int $id_salary)
    {
        return $this->employeeModel->getOneSalary($id_salary);
    }
}