<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\Client\ProductService;
use App\Services\LogInterface;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;
use Mockery;

class ProductServiceTest extends TestCase
{
    private $loggerMock;
    private $productMock;
    private $productService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loggerMock = Mockery::mock(LogInterface::class);
        $this->productMock = Mockery::mock(Product::class);
        $this->productService = new ProductService($this->loggerMock, $this->productMock);
    }

    public function testGetProductsReturnsCorrectResponse()
    {
        $this->productMock->shouldReceive('where')->andReturnSelf();
        $this->productMock->shouldReceive('where')->andReturnSelf();
        $this->productMock->shouldReceive('get')->andReturn(new Collection());

        $response = $this->productService->getProducts();

        $this->assertArrayHasKey('result', $response);
        $this->assertArrayHasKey('cart', $response);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}