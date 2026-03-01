<?php

namespace Core;

use Core\View;
use Core\Post;
use Core\Get;

abstract class Controller
{
    protected View $view;
    protected Post $post;
    protected Get $get;

    public function __construct()
    {
        $this->view = new View();
        $this->post = new Post(); 
        $this->get = new Get(); 
    }

    public function hasRole(string|int $role) : bool 
    {
        return ($role == 1) ? true : false;
    }

    protected function redirect(string $path) : void
    {
        header("Location: $path");
        die;
    }
}
