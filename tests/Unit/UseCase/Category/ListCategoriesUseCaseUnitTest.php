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

    protected $spy;

    public function testListCategoriesEmpty()
    {
        $mockPagination = $this->mockPaginations();

        $this->mockRepo = Mockery::mock(CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter', 'desc']);

        $useCase = new ListCategoriesUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertCount(1, $responseUseCase->items);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $responseUseCase);

        /**
         * Spies
         */

        $this->spy = Mockery::spy(CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('paginate')->andReturn($mockPagination);
        $useCase = new ListCategoriesUseCase($this->spy);
        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('paginate');
    }

    public function testListcategories()
    {
        $register = (object) [
            'id'          => '2093eu2309ued230e9u2j3',
            'name'        => 'Category 1',
            'description' => 'Description 1',
            'is_active'   => 'active',
            'created_at'  => '2021-01-01 00:00:00',
            'updated_at'  => '2021-01-02 00:00:00',
            'deleted_at'  => '2021-01-03 00:00:00',
        ];

        $mockPagination = $this->mockPaginations([$register]);

        $this->mockRepo = Mockery::mock(CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter', 'desc']);

        $useCase = new ListCategoriesUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertCount(1, $responseUseCase->items);
        $this->assertInstanceOf(stdClass::class, (object) $responseUseCase->items[0]);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $responseUseCase);
    }

    protected function mockPaginations(array $items = [])
    {
        $this->mockPagination = Mockery::mock(PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn([$items]);
        $this->mockPagination->shouldReceive('total')->andReturn(0);
        $this->mockPagination->shouldReceive('firstPage')->andReturn(1);
        $this->mockPagination->shouldReceive('lastPage')->andReturn(1);
        $this->mockPagination->shouldReceive('currentPage')->andReturn(1);
        $this->mockPagination->shouldReceive('perPage')->andReturn(10);
        $this->mockPagination->shouldReceive('to')->andReturn(0);
        $this->mockPagination->shouldReceive('from')->andReturn(0);

        return $this->mockPagination;
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}