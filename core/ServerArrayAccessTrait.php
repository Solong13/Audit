<?php

namespace Core;

trait ServerArrayAccessTrait 
{
    private array $serverArray;

    public function get(?string $key = null)
    {   
        return  $this->serverArray[$key] ?? $this->serverArray;
    }

    public function has(string $key)
    {   
        return isset($this->serverArray[$key]);
    }
}