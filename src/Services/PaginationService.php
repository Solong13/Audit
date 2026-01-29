<?php

namespace Src\Services;

use Core\Paginator;
use Src\Models\PortfolioModel;

class PaginationService
{
    public function paginate(
        object $model,
        int $page,
        int $perPage,
        string $orderBy,
        string $table
    ): array {
        $total = $model->countAll($table);

        $paginator = new Paginator($page, $perPage, $total);

        return [
            'rows' => $model->findPaginated(
                $paginator->perPage(),
                $paginator->offset(),
                $table,
                $orderBy
            ),
            'pagination' => [
                'current' => $paginator->page(),
                'pages' => $paginator->pages()
            ]
        ];
    }

}
