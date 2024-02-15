<?php

namespace App\Services\Admin;

use App\Models\Category;

class CategoryService
{
    /**
     * Category class
     *
     * @var object
     */
    private $category;

    /**
     * Construct category service
     *
     * @param Category $category
     * 
     */
    public function __construct(Category $category)
    {
        (object) $this->category = $category;
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
        return $this->category::findOrFail($id);
    }

    /**
     * Getting all categories
     *
     * @return array
     * 
     */
    public function getAllCategories(): object
    {
        return $this->category->getAllCategories();
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
        $this->category::create(['title' => $title]);
    }
    /**
     * Update current category
     *
     * @param object $data
     * 
     */
    public function updateCategory(object $data)
    {
        $title = $data->title;
        $this->category::update(['title' => $title]);
    }
    /**
     * Delete current category
     *
     * @param int $id
     * 
     */
    public function destroy(int $id)
    {
        $this->category::destroy($id);
    }
    
}
