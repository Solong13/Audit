<?php 

namespace Src\Interfaces;

interface RepositoryInterface
{
    public function countAll(string $table): int;

    public function countAllById(string $table, int|string $id): int;

    public function findPaginated(int $limit, int $offset, string $table, string $orderBy): array;

    public function findPaginatedById(int $limit, int $offset, string $table, int|string $id, string $orderBy): array;
}