<?php

namespace App\Infrastructure\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Connection;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\ProductInterface;

class ProductService implements ProductInterface
{
    /**
     * Model: Product
     *
     * @var object
     */
    protected $product;
    /**
     * Category class
     *
     * @var object
     */
    protected $logger;

    /**
     * Construct product service
     *
     * @param Product $product
     * @param Category $category
     * @param LogInterface $logger
     * @param Connection $database
     * 
     */
    protected function __construct(
        Product $product,
        LogInterface $logger
    ) {
        $this->product = $product;
        $this->logger = $logger;
    }

    /**
     * Getting products
     *
     * @return object
     * 
     */
    public function getProducts(int $count): ?object
    {
        if (!$count) {
            $this->logger->error('The quantity has not been transferred.');
            return null;
        }

        try {
            $products = $this->product::paginate($count);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the products: ' . $e->getMessage());
            return null;
        }

        return $products;
    }

    /**
     * Get product
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getProduct(int $id): ?object
    {
        if (!$id) {
            $this->logger->error('The id has not been transferred.');
            return null;
        }

        try {
            $product = $this->product::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the product: ' . $e->getMessage());
            return null;
        }

        return $product;
    }
}
