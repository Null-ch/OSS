<?php

namespace App\Services\Client;

use App\Models\Category;
use App\Services\LogInterface;

class CategoryService
{
    /**
     * LogInterface implementation
     *
     * @var object
     */
    private $logger;


    /**
     * Model: Category
     *
     * @var object
     */
    private $category;

    /**
     * Construct client product service
     *
     * @param LogInterface $logger
     * @param Category $category
     * 
     */
    public function __construct(LogInterface $logger, Category $category)
    {
        (object) $this->logger = $logger;
        (object) $this->category = $category;
    }

    /**
     * Get categories
     * 
     * @return array
     * 
     */
    public function getCategories(): array
    {
        try {
            $categories = $this->category::where('deleted_at', null)
                ->get();

            if ($categories) {
                $response = [
                    'result' => true,
                    'cart' => $categories,
                ];
            } else {
                $response = [
                    'result' => false,
                    'message' => 'Категории отсутствуют'
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting categories: ' . $e->getMessage());
            $response = [
                'result' => false,
                'message' => 'Категории отсутствуют'
            ];
        }

        return $response;
    }

    /**
     * Get category
     *
     * @return object
     * 
     */
    public function getCategory(int $id): ?object
    {
        try {
            $category = $this->category::findOrFail($id);
            return $category;
        } catch (\Exception $e) {
            $this->logger->error('Error when getting category: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Getting products by category id
     *
     * @param int $id
     * 
     * @return array
     * 
     */
    public function getProducts(int $id): array
    {
        try {
            $category = $this->getCategory($id);

            if ($category) {
                $products = $category->products;

                if ($products->isNotEmpty()) {
                    $products->load('images');
                    $response = [
                        'result' => true,
                        'products' => $products
                    ];
                } else {
                    $response = [
                        'result' => false,
                        'message' => 'Товары отсутствуют'
                    ];
                }
            } else {
                $response = [
                    'result' => false,
                    'message' => 'Категория не найдена'
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting products: ' . $e->getMessage());
            $response = [
                'result' => false,
                'message' => 'Произошла ошибка при получении товаров'
            ];
        }

        return $response;
    }
}
