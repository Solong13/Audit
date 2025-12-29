<?php 

namespace Core; 

class Router
{

    private Session $session; 

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function run()
    {
        // Значення за замовчуванням
        $controllerName = 'Portfolio';
        $actionName = 'portfolio';
        $param = null;

        // Отримуємо URL типу /controller/action
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $segments = explode('/', $uri);

        if (!empty($segments[0])) {
            $controllerName = ucfirst($segments[0]);
        }

        if (!empty($segments[1])) {
            $actionName = $segments[1];
        } else {
            $actionName = strtolower($controllerName);
        }

        if (!empty($segments[2])) {
            $param = ucfirst($segments[2]);
        }

        // if ($uri !== "") {
        //     $actionName = strtolower($controllerName);
        // }

        // Формуємо повні назви
        $controllerClass = "Src\\Controllers\\{$controllerName}Controller";
        $actionMethod = "{$actionName}Action";

        if (!class_exists($controllerClass)) {
            $this->error404("Controller {$controllerClass} not found");
            return;
        }

        $controller = new $controllerClass($this->session);

        if (!method_exists($controller, $actionMethod)) {
            $this->error404("Action {$actionMethod} not found");
            return;
        }
        
        try {
            $controller->$actionMethod($param);
        } catch (\Throwable $th) {
            error_log($th);
            $this->error500();
        }
    }

    private function error404(string $msg = '')
    {
        http_response_code(404);
        echo "<h1>404 Page Not Found</h1>";
        if ($msg) { echo "<p>{$msg}</p>"; }
        exit;
    }

    private function error500()
    {
        http_response_code(500);
        echo "<h1>500 Internal Server Error</h1>";
        exit;
    }
}
/*
dump() - роздрукувати
dd() - роздрукувати і завершити die()
*/