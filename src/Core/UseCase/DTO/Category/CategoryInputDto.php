<?php

namespace Core\UseCase\Category;

class CategoryInputDto
{
    public function __construct(
        public string $id = '',
    ) {}

    public function execute(CategoryInputDto $input)
    {
        
    }
}