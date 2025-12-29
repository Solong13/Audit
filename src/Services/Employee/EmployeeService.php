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
        /*
        Створюємо сесію дод необхідні дані для працівника, щоб не викликати постійно методи бд

        */

        $searchSalary = $this->employeeModel->getCurrentEmployee($idEmployee); 
        $countSalary = $this->employeeModel->countRow($idEmployee); 

        // Придумати як це переписати!

        if ($countSalary > 0) {
            $this->session->add('temporary_billing_data', [
                'id_employee' => $idEmployee,
                'id_position' => $searchSalary[0]['id_position']
            ]);

            return [
                'for_profil' => $searchSalary[0],
                'salary' => $searchSalary
            ];
        } else {
            $EmployeewithoutSalary = $this->employeeModel->getEmployee($idEmployee);
            $this->session->add('temporary_billing_data', [
                'id_employee' => $idEmployee,
                'id_position' => $EmployeewithoutSalary['id_position']
            ]);

            return [
                'for_profil' => $EmployeewithoutSalary
            ];
        }

    }
}