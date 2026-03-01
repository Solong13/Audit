<?php

namespace Core;

class Route {
    public string $method;
    public string $path;
    public array $handler;
    public array $middleware = [];
    public array $params = [];

    public function __construct(string $method, string $path, array $handler) {
        $this->method  = $method;
        $this->path    = $path;
        $this->handler = $handler;
    }

    // Масив для розширння можливостей по типу['auth', 'admin', 'csrf']
    public function middleware(string $middleware): self {
        $this->middleware[] = $middleware;
        return $this;
    }

    public function matches(\Core\Request $request) : bool
    {
        $routeParts   = explode('/', trim($this->path, '/'));
        $requestParts = explode('/', trim($request->getPath(), '/'));

        if (count($routeParts) !== count($requestParts)) {
            return false;
        }

        foreach ($routeParts as $i => $part) {
            // параметр {id}
            if (preg_match('/^{(\w+)}$/', $part, $m)) {
                $this->params[$m[1]] = $requestParts[$i];
                continue;
            }

            if ($part !== $requestParts[$i]) {
                return false;
            }
        }

        return true;
    }

}
