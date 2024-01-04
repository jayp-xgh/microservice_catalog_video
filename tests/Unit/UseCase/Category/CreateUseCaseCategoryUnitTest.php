<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function testCreateNewCategory()
    {
        // $this->mockEntity = Mockery::mock(Category::class, [
        //     $id = '1',
        //     $name = 'Category 1',
        // ]);
        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('insert'); //->andReturn($this->mockEntity);

        $useCase = new CreateCategoryUseCase($this->mockRepository);
        $useCase->execute();
        $this->assertTrue(true);
        Mockery::close();
    }
}