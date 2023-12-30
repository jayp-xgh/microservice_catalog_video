<?php

namespace Tests\UnitDomain\Entity;

use Core\Test;
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
        
        $this->assertEquals('New name', $category->getName());
        $this->assertEquals('New description', $category->getDescription());
        $this->assertEquals(true, $category->isActive());
    }
}