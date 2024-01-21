<?php


namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function insert(Category $category): Category;
    public function findById(string $id): array;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(int $page = 1, int $totalPage = 15, $order = 'DESC'): array;
    public function updadate(Category $category): Category;
    public function delete(string $id): bool;
    public function toCategory(object $data): Category;
}