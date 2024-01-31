
<?php

namespace Core\UseCase\Category;

class CategoryOutputDto
{
    public function __construct(
        public string $id = '',
    ) {}

    public function execute(CategoryInputDto $input)
    {
    }
}
