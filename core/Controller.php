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

    // Ініціалізуємо $view через DI
    public function __construct()
    {
        $this->view = new View();
        $this->post = new Post(); 
        $this->get = new Get(); 
    }

    // Метод для первірки ролі Адмін ролі!
    public function hasRole(string $role): bool 
    {
        return ($role == 1) ? true : false;
    }

    // Редірект
    protected function redirect(string $path): void
    {
        header("Location: $path");
        die;
    }
}
