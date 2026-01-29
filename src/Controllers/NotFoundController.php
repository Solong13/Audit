<?php

namespace Src\Controllers;

use Core\Controller;
use Core\Session;

class NotFoundController extends Controller
{    
    private Session $session;

    public function __construct(Session $session)
    {   
        parent::__construct();
        $this->session = $session;
    }

    public function notFoundAction() 
    {
       return $this->view->render('404');
    }
}