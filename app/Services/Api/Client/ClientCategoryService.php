<?php

namespace App\Services\Api\Client;

use App\Models\Category;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\CategoryService;

class ClientCategoryService extends CategoryService
{
    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;


    /**
     * Model: Category
     *
     * @var object
     */
    protected $category;

    /**
     * Construct client product service
     *
     * @param LogInterface $logger
     * @param Category $category
     * 
     */
    public function __construct(
        LogInterface $logger,
        Category $category
    ) {
        parent::__construct($logger, $category);
    }

    /**
     * Getting products by category id
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getProducts(int $id): ?object
    {
        try {
            $category = $this->getCategory($id);
            if ($category) {
                $category->load('products.images');
                if (!$category->products->isNotEmpty()) {
                    return null;
                }
            } else {
                return null;
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting products: ' . $e->getMessage());
            return null;
        }

        return $category;
    }
}
