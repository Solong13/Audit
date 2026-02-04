<?php

namespace Src\Services\Portfolio;

use Src\Models\PortfolioModel;
use Src\Services\PaginationService;


class PortfolioService
{
    public function __construct(private PaginationService $paginationService, private PortfolioModel $portfolioModel)
    {
        $this->paginationService = $paginationService;
        $this->portfolioModel = $portfolioModel;
    }

    public function getSomeEmployees(int|string $page) : array
    {
        return $this->paginationService->paginate(
            $this->portfolioModel,
            $page,
            2,
            'employees'
        );
    }

    public function getSomeSalaries(int|string $id, int|string $page) : array|bool
    {   

        $result = $this->paginationService->paginate(
            $this->portfolioModel,
            $page,
            1,
            'salaries',
            $id,
        );

        return $result ? $result : false;
        
    }
}