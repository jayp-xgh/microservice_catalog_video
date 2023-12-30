<?php

namespace Core\Domain\Entity;
class Category
{
    public function __construct(
        private string $name,
        private string $description,
        private bool $isActive
    ) {}

    
}