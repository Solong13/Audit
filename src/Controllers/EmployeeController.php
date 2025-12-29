<?php  

namespace Src\Controllers;

use Core\Session;
use Core\Controller;
use Src\Services\Employee\EmployeeService;

class EmployeeController extends Controller
{
    public EmployeeService $employeeService;
    private Session $session;

    public function __construct(Session $session)
    {   
        parent::__construct();
        $this->session = $session;
        
    }

    public function salaryAction($id) 
    {
        /*
            (Користувач може побачити записи інших користувачів змінивши id)
            Мені передають id користувача 
                - Витягнути з бд всі його зарплати(яку одну так і більше)
                - та змога додавати,редагувати,видаляти та оновлювати ЗП
        */
        $this->employeeService = new EmployeeService($this->session);
        $theSalaryOfEmployee = $this->employeeService->getEmployeeData((int)$id); 
        echo $this->view->render('employee_page', $theSalaryOfEmployee); 
    }

    public function accrualAction() 
    {
                dd(
            session_id(),
            $_SESSION,
            $this->session->get('temporary_billing_data')
        );
 
    }
}
