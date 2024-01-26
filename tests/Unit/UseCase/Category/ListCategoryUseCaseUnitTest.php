<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category as CategoryEntity;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class ListCategoryCaseUnitTest extends TestCase
{
    public function testGetById()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $this->mockEntity = Mockery::mock(CategoryEntity::class, [
            $uuid,
            'Name Category',
        ]);

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('findById')
            ->with($id)
            ->andReturn($this->mockEntity);
    }
}