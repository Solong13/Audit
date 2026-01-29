<?php

namespace Core;

class Paginator
{
    private int $page;
    private int $perPage;
    private int $total;

    public function __construct(int $page, int $perPage, int $total)
    {
        $this->page = max(1, $page);
        $this->perPage = $perPage;
        $this->total = $total;
    }

    public function offset(): int
    {
        return ($this->page - 1) * $this->perPage;
    }

    public function pages(): int
    {
        return (int) ceil($this->total / $this->perPage);
    }

    public function page(): int
    {
        return $this->page;
    }

    public function perPage(): int
    {
        return $this->perPage;
    }
}