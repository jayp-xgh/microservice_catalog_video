<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            DomainValidation::notNull('', 'Name is required');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullCustomMessageException()
    {
        try {
            DomainValidation::notNull('', 'Custom message error');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th,'Custom message error');
        }
    }

    public function testStrMaxLangth()
    {
        try {
            DomainValidation::strMaxLength('12345', 5, 'Custom message error');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testStrMinLangth()
    {
        try {
            DomainValidation::strMinLength('1', 2, 'Custom message error');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testStrCanNullAndMaxLangth()
    {
        try {
            DomainValidation::strCanNullAndMaxLength('1234', 3, 'Custom message error');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'Custom message error');
        }
    }
}