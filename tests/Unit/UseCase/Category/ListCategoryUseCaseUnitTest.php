<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category as CategoryEntity;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CategoryCreateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class ListCategoryCaseUnitTest extends TestCase
{
    public function testGetById()
    {
        $id = (string) Uuid::uuid4()->toString();
        $this->mockEntity = Mockery::mock(CategoryEntity::class, [
            $id,
            'Name Category',
        ]);

        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('findById')
            ->with($id)
            ->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryInputDto::class, [
            'id' => $id,
        ]);
        $useCase = new ListCategoryUseCase($this->mockRepository);
        $response = $useCase->execute($this->mockInputDto);
        $this->assertInstanceOf(CategoryCreateOutputDto::class, $response);
        $this->assertEquals('Name Category', $response->name);
        $this->assertEquals($id, $response->id);
    }
}