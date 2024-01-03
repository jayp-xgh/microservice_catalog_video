<?php

namespace Tests\UnitDomain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'New name',
            description: 'New description',
            isActive: true
        );

        $this->assertNotEmpty($category->id);
        $this->assertEquals('New name', $category->name);
        $this->assertEquals('New description', $category->description);
        $this->assertEquals(true, $category->isActive);
        $this->assertNotEmpty($category->createdAt());
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'New name',
        );

        $this->assertTrue($category->isActive);
        $category->desablet();
        $this->assertFalse($category->isActive);
    }


    public function testUpdate()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'New name',
            description: 'New description',
            isActive: true,
            createdAt: '2023-01-01 00:00:00'
        );

        $category->update(
            name: 'New_name',
            description: 'New_description',
        );

        $this->assertEquals($uuid, $category->id);
        $this->assertEquals('New_name', $category->name);
        $this->assertEquals('New_description', $category->description);
    }

    public function testExceptionName()
    {
        try {
            new Category(
                name: 'Ne',
                description: 'New description',
            );
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
    public function testExceptionDescription()
    {
        try {
            new Category(
                name: 'Neme Cat',
                description: random_bytes(999),
            );

            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}