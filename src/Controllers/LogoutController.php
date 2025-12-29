<?php 

namespace Src\Controllers;

use Core\Session;
use Core\Controller;

class LogoutController extends Controller
{
    private Session $session;

    public function __construct(Session $session)
    {   
        parent::__construct(); 
        $this->session = $session;
    }

    public function logoutAction() 
    {
        $this->session->clear();
        $this::redirect('login');
    }
}