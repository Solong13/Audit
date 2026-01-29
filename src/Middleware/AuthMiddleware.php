<?php

namespace Src\Middleware;

use Core\Session;

class AuthMiddleware 
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function handle(): void {
        if (empty($this->session->has('employee'))) {
            header('Location: /login');
            exit;
        }
    }
}

