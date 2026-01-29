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

    public function getSomeEmployees(int|string $page) 
    {
        $result = $this->paginationService->paginate(
            $this->portfolioModel,
            $page,
            5,
            'id_employee',
            'employees'
        );

        $result['dataForView'] =
            $this->portfolioModel->getAllEmployeeAndTheirPositions();

        return $result;
    }

    public function getSomeSalaries(int|string $id, int|string $page) : array|bool
    {   
        $listOfSalaries = $this->portfolioModel->getSalaryCurrentEmployee($id);
        
        if (!empty($listOfSalaries)) {
            $result = $this->paginationService->paginate(
                $this->portfolioModel,
                $page,
                5,
                'id_employee',
                'salaries'
            );
            $result['dataForView'] = sortedDataEmployee($listOfSalaries);
            return $result;
        }
        return false;
    }
}