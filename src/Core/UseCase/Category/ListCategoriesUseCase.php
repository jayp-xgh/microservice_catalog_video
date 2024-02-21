<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategories\{
    ListCategoriesInputDto,
    ListCategoriesOutputDto
};

class ListCategoriesUseCase
{
    protected $repository;
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListCategoriesInputDto $input): ListCategoriesOutputDto
    {
        $categories = $this->repository->paginate(
            filter   : $input->filter,
            order    : $input->order,
            page     : $input->page,
            totalPage: $input->totalPage,
        );

        return new ListCategoriesOutputDto(
            items      : $categories->items(),
            total      : $categories->total(),
            firstPage  : $categories->firstPage(),
            lastPage   : $categories->lastPage(),
            currentPage: $categories->currentPage(),
            perPage    : $categories->perPage(),
            to         : $categories->to(),
            from       : $categories->from(),
        );
    }
}
