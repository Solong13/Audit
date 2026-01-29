<?php

namespace Src\Controllers;

use Core\Controller;
use Core\Session;
use Src\Services\Registration\LogUpService;

class RegistrationController extends Controller
{   
    private Session $session;
    private LogUpService $logUpService;

    public function __construct(Session $session)
    {
        parent::__construct();
        $this->session = $session;
        $this->logUpService = new LogUpService($this->session);
    }

    public function registrationAction() : mixed
    {
        $dataForUserForm = $this->logUpService->getDataForRegForm();
        return $this->view->render('/registration', $dataForUserForm);
    }

    public function newEmployeeAction()
    {
        $this->logUpService->logUp($this->post->get());
        return $this->redirect('/registration');
    }
}