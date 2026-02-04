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
        string $table = '',
        string|int $id = '',
        string $orderBy = 'DESC'
        
    ): array{

        $modelResult = null;
        if (isset($id) && !empty($id)) {
        $total = $model->countAllById($table, $id);
        $paginator = new Paginator($page, $perPage, $total);
        //dd($total);
            $modelResult = $model->findPaginatedById(
                $paginator->perPage(),
                $paginator->offset(),
                $table,
                $id,
                $orderBy
            );
        } else {
            $total = $model->countAll($table);
            $paginator = new Paginator($page, $perPage, $total);
           // dd($paginator->offset());
            $modelResult = $model->findPaginated(
                $paginator->perPage(),
                $paginator->offset(),
                $table,
                $orderBy
            );
        }

        return [
            'rows' => $modelResult,
            'pagination' => [
                'current' => $paginator->page(),
                'pages' => $paginator->pages()
            ]
        ];
    }

}
