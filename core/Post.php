<?php

namespace Core;

final class Post 
{
    use ServerArrayAccessTrait;
    use MutableServerArrayTrait;

    public function __construct()
    {
        $this->serverArray = &$_POST;
    }
}