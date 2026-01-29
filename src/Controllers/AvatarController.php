<?php

namespace Src\Controllers;

use Core\Controller;
use Core\Session;
use Src\Services\Avatar\PhotoService;

class AvatarController extends Controller
{    
    private Session $session;
    private PhotoService $photoService;

    public function __construct(Session $session)
    {   
        parent::__construct();
        $this->session = $session;
        $this->photoService = new PhotoService($this->session);
        $UserRole = $this->session->get('employee');
        parent::hasRole($UserRole['id_employee']);
    }

    public function uploadAction()
    {
        $this->photoService->handlerPhoto($this->post->get('id_employee'), $_FILES);
        $this::redirect('/employee/salary/'.$this->post->get('id_employee'), $this->session->get());
    }
}