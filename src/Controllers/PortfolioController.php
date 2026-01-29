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

        $page = isset($request['page']) ? (int)$request['page'] : 1;

        if ($chekRoleEmployee ) {
            return $this->view->render('portfolio_admin', $this->portfolioService->getSomeEmployees($page));
        } else {
            $getSalaryEmployee = $this->portfolioService->getSomeSalaries($roleEmployee['id_employee'], $page);
            //dd( $sortedData);
            return $this->view->render('portfolio_employee', $getSalaryEmployee ?? []);
        }

    }

}