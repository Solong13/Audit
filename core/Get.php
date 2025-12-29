<?php

namespace Core;

final class Get 
{
    use ServerArrayAccessTrait;
    use MutableServerArrayTrait;

    public function __construct()
    {
        $this->serverArray = &$_GET;
    }
}