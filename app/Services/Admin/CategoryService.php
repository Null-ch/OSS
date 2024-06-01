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
     * @param LogInterface $logger
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
    public function getCategory(int $id): ?object
    {
        try {
            $category =  $this->category::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when getting category: ' . $e->getMessage());
            return null;
        }

        return $category;
    }

    /**
     * Getting all categories
     *
     * @param int $count
     * 
     * @return object
     * 
     */
    public function getAllCategories(int $count): ?object
    {
        try {
            $categories =  $this->category::paginate($count);
        } catch (\Exception $e) {
            $this->logger->error('Error when getting categories: ' . $e->getMessage());
            return null;
        }

        return $categories;
    }

    /**
     * Create new category
     *
     * @param array $data
     * 
     */
    public function createCategory(array $data)
    {
        try {
            $file = $data['preview_image'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/img/categories/');

            //Если разворачиваешь на nix то измени на mkdir($destinationPath, 0755, true);
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath);
            }

            $path = 'img/categories/' . $filename;
            $file->move(public_path('img/categories/'), $filename);
            $data['preview_image'] = $path;
            $this->category::create($data);
        } catch (\Exception $e) {
            $this->logger->error('Error when creating a category: ' . $e->getMessage());
        }
    }

    /**
     * Update current category
     *
     * @param array $data
     * @param int $id
     * 
     * 
     */
    public function updateCategory(array $data, int $id)
    {
        $category = $this->getCategory($id);
        if ($category) {
            try {
                if (isset($data['preview_image'])) {
                    $file = $data['preview_image'];
                    $filename = time() . '_' . $file->getClientOriginalName();

                    $destinationPath = public_path('img/categories/');

                    //Если разворачиваешь на nix то измени на mkdir($destinationPath, 0755, true);
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath);
                    }

                    $path = 'img/categories/' . $filename;
                    $file->move(public_path('img/categories/'), $filename);
                    $data['preview_image'] = $path;
                }
                $category->update($data);
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

    /**
     * Func for chenge activity of category
     *
     * @param int $id
     * 
     */
    public function toggleActivity(int $id)
    {
        $category = $this->getCategory($id);
        if ($category) {
            $category->is_active == 1 ? $category->is_active = 0 : $category->is_active = 1;
            $category->save();
        }
    }
}
