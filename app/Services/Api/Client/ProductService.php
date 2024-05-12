<?php

namespace App\Services\Api\Client;

use App\Models\Product;
use App\Services\LogInterface;

class ProductService
{
    /**
     * LogInterface implementation
     *
     * @var object
     */
    private $logger;


    /**
     * Model: Product
     *
     * @var object
     */
    private $product;

    /**
     * Construct client product service
     *
     * @param LogInterface $logger
     * @param Product $product
     * 
     */
    public function __construct(LogInterface $logger, Product $product)
    {
        (object) $this->logger = $logger;
        (object) $this->product = $product;
    }

    /**
     * Get products
     * 
     * @return array
     * 
     */
    public function getProducts(): array
    {
        try {
            $products = $this->product::where('is_active', true)
                ->where('deleted_at', null)
                ->get();

            if ($products) {
                $products->load('images');
                $response = [
                    'result' => true,
                    'products' => $products,
                ];
            } else {
                $response = [
                    'result' => false,
                    'message' => 'Товары отсутствуют'
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting products: ' . $e->getMessage());
            $response = [
                'result' => false,
                'message' => 'Товары отсутствуют'
            ];
        }

        return $response;
    }

    /**
     * Get product
     *
     * @return object
     * 
     */
    public function getProduct(int $id): array
    {
        try {
            $product = $this->product::where('is_active', true)
                ->where('deleted_at', null)
                ->findOrFail($id);
            if ($product) {
                $product->images;
                $response = [
                    'result' => true,
                    'product' => $product
                ];
            } else {
                $response = [
                    'result' => false,
                    'message' => 'Товар не найден'
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting product: ' . $e->getMessage());
            $response = [
                'result' => false,
                'message' => 'Товар не найден'
            ];
        }

        return $response;
    }
}
