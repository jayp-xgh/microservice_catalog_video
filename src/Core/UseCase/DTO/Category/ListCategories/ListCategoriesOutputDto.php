<?php

namespace Core\UseCase\DTO\Category\ListCategories;

class ListCategoriesOutputDto
{
    public function __construct(
        public array $items,
        public int $total,
    ) {}
}