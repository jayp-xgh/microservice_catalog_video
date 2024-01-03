<?php

namespace Core\Domain\Entity;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Category
{
    use MethodsMagicsTrait;
    public function __construct(
        protected Uuid|string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::generate();
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