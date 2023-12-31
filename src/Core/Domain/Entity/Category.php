<?php

namespace Core\Domain\Entity;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Validation\DomainValidation;

class Category
{
    use MethodsMagicsTrait;
    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
        $this->validate();
    }

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
        $this->validate();
    }

    public function validate ()
    {
        DomainValidation::strMaxLangth($this->name);
        DomainValidation::strMinLangth($this->name);
        DomainValidation::strCanNullAndMaxLangth($this->description);
    }    
}