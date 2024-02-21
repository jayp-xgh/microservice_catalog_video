<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\UseCase\Category\ListCategoriesUseCase;
use Core\UseCase\DTO\Category\ListCategories\{
    ListCategoriesInputDto,
    ListCategoriesOutputDto
};
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class ListCategoriesUseCaseUnitTest extends TestCase
{
    protected $mockRepo;
    protected $mockPagination;
    protected $mockInputDto;

    public function testListCategoriesEmpty()
    {
        $this->mockPagination = Mockery::mock(PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn([]);
        $this->mockPagination->shouldReceive('total')->andReturn(0);

        $this->mockRepo = Mockery::mock(CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('paginate')->andReturn($this->mockPagination);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter', 'desc']);

        $useCase = new ListCategoriesUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertCount(0, $responseUseCase->items);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $responseUseCase);
    }
}