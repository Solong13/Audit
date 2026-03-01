<?php

use PHPUnit\Framework\TestCase;
use Core\Paginator;

/*Треба придумати кращий приклад*/

class PaginatorTest extends TestCase
{
    private Paginator $paginator;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_offset() 
    {
        $this->paginator = new Paginator(2, 5, 10);
        $this->assertEquals(5, $this->paginator->offset()); 
    }
}
