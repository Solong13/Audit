<?php

namespace Src\Services\Employee;

use Src\Models\EmployeeModel;
use Core\Session;

class EmployeeService 
{
    private EmployeeModel $employeeModel; 
    private Session $session;

    public function __construct(Session $session)
    {   
        $this->employeeModel = new EmployeeModel();
        $this->session = $session;
    }

    public function getEmployeeData(int $idEmployee)
    {
        $searchSalary = $this->employeeModel->getCurrentEmployee($idEmployee); 
        $countSalary = $this->employeeModel->countRow($idEmployee); 

        if ($countSalary > 0) {
            return [
                'for_profil' => $searchSalary[0],
                'salary' => $searchSalary,
                //'errorPhoto' => $this->session->get('errorPhoto')
            ];
        } else {
            return [
                'for_profil' => $this->employeeModel->getEmployee($idEmployee),
                //'errorPhoto' => $this->session->get('errorPhoto')
            ];
        }

    }

}