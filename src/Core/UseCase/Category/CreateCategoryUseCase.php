<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;

class CreateCategoryUseCase
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute()
    {
        $category = new Category(
            name: 'Category 1',
            description: 'Description 1',
        );
        var_dump($category);
        $this->categoryRepository->insert($category);
    }
}