<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(
        string $value,
        string $execptionMessage = null
    ): void
    {   
        if (empty($value)) {
            throw new EntityValidationException($execptionMessage ?? 'Should not be empty or null');
        }
    } 
}