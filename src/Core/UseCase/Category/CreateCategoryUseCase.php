<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\DTO\Category\{
    CategoryCreateInputDto,
    CategoryCreateOutputDto,
};

class CreateCategoryUseCase
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(CategoryCreateInputDto $input): CategoryCreateOutputDto
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );

        $newlyInsertedCategory = $this->categoryRepository->insert($category);

        return new CategoryCreateOutputDto(
            id: $newlyInsertedCategory->id,
            name: $newlyInsertedCategory->name,
            description: $newlyInsertedCategory->description,
            is_active: $newlyInsertedCategory->isActive,
        );
    }
}