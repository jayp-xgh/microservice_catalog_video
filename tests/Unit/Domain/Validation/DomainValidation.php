<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            DomainValidation::testNotNull(null, 'Name is required');
            $this->assertTrue(true);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}