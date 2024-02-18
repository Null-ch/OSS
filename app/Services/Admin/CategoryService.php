<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Services\LogInterface;

class CategoryService
{
    /**
     * Model: Category
     *
     * @var object
     */

    private $category;
    /**
     * LogInterface implementation
     *
     * @var object
     */

    private $logger;
    /**
     * Construct category service
     *
     * @param Category $category
     * 
     */
    public function __construct(Category $category, LogInterface $logger)
    {
        (object) $this->category = $category;
        (object) $this->logger = $logger;
    }

    /**
     * Get category
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getCategory(int $id): object
    {
        try {
            $category =  $this->category::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when getting category: ' . $e->getMessage());
            return [];
        }

        return $category;
    }

    /**
     * Getting all categories
     *
     * @return array
     * 
     */
    public function getAllCategories(): object
    {
        try {
            $categories =  $this->category->getAllCategories();
        } catch (\Exception $e) {
            $this->logger->error('Error when getting categories: ' . $e->getMessage());
            return [];
        }

        return $categories;
    }

    /**
     * Create new category
     *
     * @param object $data
     * 
     */
    public function createCategory(object $data)
    {
        $title = $data->title;
        try {
            $this->category::create(['title' => $title]);
        } catch (\Exception $e) {
            $this->logger->error('Error when creating a category: ' . $e->getMessage());
        }
    }

    /**
     * Update current category
     *
     * @param object $data
     * 
     */
    public function updateCategory(object $data, int $id)
    {
        $title = $data->title;
        $category =  $this->category::findOrFail($id);
        if ($category) {
            try {
                $this->category::update(['title' => $title]);
            } catch (\Exception $e) {
                $this->logger->error('Error updating the category: ' . $e->getMessage());
            }
        }
    }

    /**
     * Delete current category
     *
     * @param int $id
     * 
     */
    public function destroy(int $id)
    {
        try {
            $this->category::destroy($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when deleting a category: ' . $e->getMessage());
        }
    }
}
