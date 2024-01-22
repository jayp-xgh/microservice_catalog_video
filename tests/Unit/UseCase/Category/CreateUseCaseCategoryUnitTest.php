<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CategoryCreateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
    private $mockEntity;
    private $mockRepository;
    private $mockInputDto;
    private $spy;

    protected function setUp(): void
    {
        parent::setUp();
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'Category 1';

        $this->mockEntity = Mockery::mock(Category::class, [
            $uuid,
            $name = $categoryName,
        ]);

        $this->mockEntity->shouldReceive('id')->andReturn($uuid);
        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [
            $name = $categoryName,
        ]);

        $this->spy = Mockery::spy(CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);
    }
    public function testCreateNewCategory()
    {
        $useCase = new CreateCategoryUseCase($this->mockRepository);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $categoryName = 'Category 1';

        $this->assertInstanceOf(CategoryCreateOutputDto::class, $responseUseCase);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEmpty($responseUseCase->description);

        $useCase = new CreateCategoryUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->spy->shouldHaveReceived('insert')->once();
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}