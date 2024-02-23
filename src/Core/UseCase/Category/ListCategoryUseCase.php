<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\CategoryOutputDto;

class ListCategoryUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryInputDto $input): CategoryOutputDto
    {
        $category = $this->repository->findById($input->id);

        return new CategoryOutputDto(
            id         : $category->id(),
            name       : $category->name,
            description: $category->description,
            is_active  : $category->isActive,
            created_at : $category->createdAt(),
        );
    }
}
