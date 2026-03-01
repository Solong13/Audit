<?php  

namespace Src\Controllers;

use Core\Session;
use Core\Controller;
use Src\Services\Employee\EmployeeService;
use Src\Services\Employee\EmployeeSalaryCalculationService;
use Src\Services\Employee\EditSalaryService;
use Src\Services\Employee\DeleteSalarySarvice;

class EmployeeController extends Controller
{
    private EmployeeService $employeeService;
    private DeleteSalarySarvice $deleteSalarySarvice;
    private Session $session;

    public function __construct(Session $session)
    {   
        parent::__construct();
        $this->session = $session;
        $UserRole = $this->session->get('employee');
        parent::hasRole($UserRole['id_employee']);
    }

    public function salaryAction(mixed $id) 
    {
        $this->employeeService = new EmployeeService($this->session);
        $theSalaryOfEmployee = $this->employeeService->getEmployeeData((int)$id); 
 
        return $this->view->render('employee_page', $theSalaryOfEmployee); 
    }

    public function accrualAction() 
    {
        if (!empty($this->post->get('All_hours_c6')) && !empty($this->post->get('Night_shift_hours_c11'))) {
            $employeeSalaryCalculationService = new EmployeeSalaryCalculationService();
            $employeeSalaryCalculationService->salaryCalculation($this->post->get());
            $this::redirect('/employee/salary/'.$this->post->get('id_employee'));
        } else {
            $this->session->add('errorSalary', 'Fill the fields!');
            
            $this::redirect('/employee/salary/'.$this->post->get('id_employee'));
        }
    }

    public function editAction(string $id_salary) 
    {
        $editSalaryService = new EditSalaryService();
        $result = $editSalaryService->editSalary($id_salary);

        return $this->view->render('edit_salary', $result[0]);
    }

    public function deleteAction(int|string $id_salary, int|string $id_employee) 
    {
        $deleteSalarySarvice = new DeleteSalarySarvice();
        $deleteSalarySarvice->deleteSalary($id_salary);

        $this::redirect('/employee/salary/'.$id_employee);
    }
}
