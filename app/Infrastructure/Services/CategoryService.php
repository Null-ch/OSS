<?php

namespace App\Infrastructure\Services;

use App\Models\Category;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\CategoryInterface;


class CategoryService implements CategoryInterface
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
        $this->logger = $logger;
        $this->category = $category;
    }

    /**
     * Get categories
     * 
     * @return array
     * 
     */
    public function getCategories(int $count): ?object
    {
        try {
            $categories = $this->category::where('deleted_at', null)
                // ->where('is_active', true)
                ->paginate($count);

            if ($categories->isNotEmpty()) {
                return $categories;
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting categories: ' . $e->getMessage());
            return null;
        }

        return null;
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
            $category = $this->category::where('deleted_at', null)
                // ->where('is_active', true)
                ->findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when getting category: ' . $e->getMessage());
            return null;
        }

        return $category;
    }
    public function getAllCategories(): ?object
    {
        try {
            $categories = $this->category::where('deleted_at', null)->get();

            if ($categories->isNotEmpty()) {
                return $categories;
            }
        } catch (\Exception $e) {
            $this->logger->error('Error when getting categories: ' . $e->getMessage());
            return null;
        }

        return null;
    }
}
