<?php 

namespace Core;

use Src\Controllers\NotFoundController;
use Src\Middleware\AuthMiddleware;

class Router
{
    private Session $session; 
    private Request $request;
    private array $routes = [];

    public function __construct(Session $session, Request $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

   public function get(string $path, array $handler): Route {
        return $this->add('GET', $path, $handler);
    }

    public function post(string $path, array $handler): Route {
        return $this->add('POST', $path, $handler);
    }

    private function add(string $method, string $path, array $handler): Route {
        $route = new Route($method, $path, $handler);
        $this->routes[] = $route;
        return $route;
    }


    public function resolve(): void {
        foreach ($this->routes as $route) {

            if ($route->matches($this->request)) {

                foreach ($route->middleware as $mw) {
                    if ($mw === 'auth') {
                        (new AuthMiddleware($this->session))->handle();
                    }
                }
                
                // Це деструктуризація масиву
                [$controller, $action] = $route->handler;
                (new $controller($this->session))->$action(...array_values($route->params));
                return;
            }
        }

        $controller = new NotFoundController($this->session);
        $controller->notFoundAction();
        
    }
}