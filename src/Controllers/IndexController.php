<?php

namespace Src\Controllers;

use Core\Controller;
use Src\Models\IndexModel;
use Core\Session;
use Src\Services\Index;
use Src\Services\Index\IndexService;

class IndexController extends Controller
{
    private IndexModel $indexDb; 
    private Session $session;
    private IndexService $indexService;
    
    public function __construct()
    {   
        $this->indexDb = new IndexModel();
        $this->session = new Session();
        $this->indexService = new IndexService();
        parent::__construct(); 
    }

    public function indexAction() 
    {
        
        $dataEmployee = $this->indexService->getDataFromClient();

        // Потрібно перевірити чи авторізований автор і перекинуть на логін пейдж
        //echo $this->view->render('portfolio', $dataEmployee); ?? чому це не працюэ
                      header("Location: portfolio");
                exit;
    }

}

/*
Зробити так щоб логін не перезавантажував безкінечно логін екшн коли авторізувався

Розібратися з виводом в шаблон і можливо його розділити
Подивитися як працювати з постом і сесіями
Додати ще сервісів
*/