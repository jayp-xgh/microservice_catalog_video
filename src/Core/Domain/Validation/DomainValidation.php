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
        if (empty($value))
            throw new EntityValidationException($execptionMessage ?? 'Should not be empty or null');
    }

    public static function strMaxLength(
        string $value,
        int $langth = 255,
        string $execptionMessage = null)
    {
        if (strlen($value) >= $langth)
            throw new EntityValidationException($execptionMessage ?? "The value must be less than {$langth} characters");
    }

    public static function strMinLength(
        string $value,
        int    $langth           = 3,
        string $execptionMessage = null)
    {
        if (strlen($value) < $langth)
            throw new EntityValidationException($execptionMessage ?? "The value must be less than {$langth} characters");
    }

    public static function strCanNullAndMaxLength(
        string $value            = '',
        int    $langth           = 255,
        string $execptionMessage = null)
    {
        if (!empty($value) && strlen($value) >  $langth)
            throw new EntityValidationException($execptionMessage ?? "The value must be less than {$langth} characters");
    }
}