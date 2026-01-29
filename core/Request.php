<?php

namespace Core;

class Request 
{
    public function getPath(): string {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($path, PHP_URL_PATH);//залишає url після localhost
        return rtrim($path, '/') ?: '/';//обрізає слеш праворуч
    }

    public function getMethod() : string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public function getBody(): array {
        return $this->getMethod() === 'GET'
            ? $_GET
            : $_POST;
    }

    // public function isGet() : bool
    // {
    //     return $this->getMethod() == "GET";
    // }

    // public function isPost() : bool
    // {
    //     return $this->getMethod() == "POST";
    // }

    // public function isAjax() : bool
    // {
    //     return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    //     $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    // }

    // public function getBody(): array 
    // {
    //     $body = [];
    //     $data = ($this->getMethod() === 'GET') ? $_GET : $_POST;
    //     foreach ($data as $value) {
    //         $body[$data] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    //     }
    //     return $body;
    // }

    //??
    // public function get($name, $default = null) : ?string
    // {
    //     return $_GET[$name] ?? $default;
    // }

    // public function post($name, $default = null) : ?string
    // {
    //     return $_POST[$name] ?? $default;
    // }
}