<?php

namespace Core;

class Application 
{
    private Session $session;
    private Post $post;
    public Router $router;
    private View $view;
    private Request $request;

    public function __construct()
    {
        $this->session = new Session();
        $this->request = new Request();
        $this->router = new Router($this->session, $this->request);
        $this->view = new View();
        $this->post = new Post();
    }

    public function run() 
    {
        $this->router->resolve();
    }

}
