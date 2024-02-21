<?php

namespace Core\UseCase\DTO\Category\ListCategories;

class ListCategoriesOutputDto
{
    public function __construct(
        public array $items,
        public int $total,
        public int $firstPage,
        public int $lastPage,
        public int $currentPage,
        public int $perPage,
        public int $to,
        public int $from
    ) {}
}