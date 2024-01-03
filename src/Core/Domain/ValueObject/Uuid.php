<?php

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(protected string $value)
    {
        $this->ensureIsValid($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function generate (): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }
    private function ensureIsValid(string $id)
    {
        if (!RamseyUuid::isValid($id))
            throw new InvalidArgumentException(sprintf('"%s" is not a valid UUID', $id));
    }


}