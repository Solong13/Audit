<?php
namespace Src\Controllers;

use Core\Controller;

use Core\Session;
use Src\Models\PortfolioModel;

class PortfolioController extends Controller
{
    private PortfolioModel $portfolioModel;
    private Session $session;

    public function __construct(Session $session)
    {   
        parent::__construct(); 
        $this->session = $session;
        $this->portfolioModel = new PortfolioModel();

    }

    /*логіка така, що користувач у нас вже Є, але потрібно ще тестити логіку програми
    ЯКЩО КОРИСТУВАЧ Є -
    - МИ витягуємо необхідні дані відповідному користувачу
    - Адміну - дані всіх користувачів
    - Працівнику його Зп
    */

    // Якщо зайшов адмін
    public function portfolioAction()
    {
        $roleEmployee = $this->session->get('employee'); // Чому нулл якщо це супер глобальний масив

        if ($roleEmployee) { 
            if ((int)$roleEmployee['employee_role'] === 1) {
                $resultOfTheAutorization = $this->portfolioModel->getAllEmployeeAndTheirPositions();
                echo $this->view->render('portfolio_admin', $resultOfTheAutorization);
            } else {
                $getSalaryEmployee =$this->portfolioModel->getSalaryCurrentEmployee($roleEmployee['id_employee']);
                $sortedData = sortedDataEmployee($getSalaryEmployee);
                // Ці дані потрібно дод в масив???
                //$baseSalary = $this->portfolioModel->getCurrentPosition($getSalaryEmployee['id_position'] ?? $getSalaryEmployee[0]['id_position']);
                echo $this->view->render('portfolio_employee', $sortedData);
            }
        } else {
            $this::redirect('login');
        }

    }

}