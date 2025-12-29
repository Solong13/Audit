<?php

namespace Core;

trait MutableServerArrayTrait 
{
    private array $serverArray;

    public function add(string $key, mixed $value)
    {   
        $this->serverArray[$key] = $value;
    }

    public function delete(string $key)
    {   
        unset($this->serverArray[$key]);
    }
}