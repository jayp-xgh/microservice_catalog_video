<?php

namespace Core\Domain\Entity;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;

class Category
{
    use MethodsMagicsTrait;
    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {}

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function desablet(): void
    {
        $this->isActive = false;
    }

    public function update(
        string $name = '',
        string $description = ''
    ): void
    {
        $this->name = $name;
        $this->description = $description;
    }
}