<?php
namespace Src\Controllers;

use Core\Controller;
use Core\Session;
use Src\Services\Portfolio\PortfolioService;
use Src\Services\PaginationService;
use Src\Models\PortfolioModel;

class PortfolioController extends Controller
{
    private Session $session;
    private PortfolioService $portfolioService;

    public function __construct(Session $session)
    {   
        parent::__construct(); 
        $this->session = $session;

        $this->portfolioService = new PortfolioService(new PaginationService(), new PortfolioModel());
    }

    public function portfolioAction()
    {
        $roleEmployee = $this->session->get('employee');
        $chekRoleEmployee = parent::hasRole((int)$roleEmployee['employee_role']);

        $page = $this->get->get('page') ? (int)$this->get->get('page') : 1;

        if ($chekRoleEmployee) {
            return $this->view->render('portfolio_admin', $this->portfolioService->getSomeEmployees($page));
        } else {
            $getSalaryEmployee = $this->portfolioService->getSomeSalaries($roleEmployee['id_employee'], $page);
            $dateRedactor = sortedDataEmployee($getSalaryEmployee['rows']);
            $getSalaryEmployee['rows'] = $dateRedactor;
            return $this->view->render('portfolio_employee', $getSalaryEmployee ?? []);
        }

    }

}