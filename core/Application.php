<?php

namespace Core;

class Application 
{
    // protected string $uri;
    // public Request $request;
    // public static Application $app;
    public Session $session;
    public Post $post;
    public Router $router;
    public View $view;

    public function __construct()
    {
        // self::$app = $this;
        // $this->uri = $_SERVER['QUERY_STRING'];
        // $this->request = new Request($this->uri);
        $this->session = new Session();
        $this->router = new Router($this->session);
        // $this->view = new View();
        // $this->post = new Post();
    }

    public function run() 
    {
        // $cechkEmployee = $this->cechkAuth();
        // if (!$cechkEmployee) {
        //     header("Location: login");
        //     exit;
        // }
        $this->router->run();
        // if($cechkEmployee) {
        //    echo $this->view->render('portfolio', $resultOfTheAutorization ?? []);
        // } else {
        //     if (!empty($this->post->get('fullname')) && !empty($this->post->get('password'))) {
        //         $this->router->run();
        //     } else {
        //         echo $this->view->render('login', $resultOfTheAutorization ?? []);
        //     }
            
        // }
    }

    private function cechkAuth() : bool 
    {
       return !empty($this->session->get('employee')) ? true : false;

    }

}