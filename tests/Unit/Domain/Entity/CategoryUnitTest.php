<?php

namespace Tests\UnitDomain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'New name',
            description: 'New description', 
            isActive: true
        );
        
        $this->assertEquals('New name', $category->name);
        $this->assertEquals('New description', $category->description);
        $this->assertEquals(true, $category->isActive);
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


}