<?php

namespace Core;

class Request 
{
    public function getPath(): string {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($path, PHP_URL_PATH);
        return rtrim($path, '/') ?: '/';
    }

    public function getMethod() : string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public function getBody() : array 
    {
        return $this->getMethod() === 'GET'
            ? $_GET
            : $_POST;
    }

}