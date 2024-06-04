<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Services\FileService;
use App\Services\LogInterface;
use Illuminate\Support\Facades\DB;

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
     * fileService
     *
     * @var object
     */
    private $fileService;

    /**
     * Construct category service
     *
     * @param Category $category
     * @param LogInterface $logger
     * 
     */
    public function __construct(Category $category, LogInterface $logger, FileService $fileService)
    {
        (object) $this->category = $category;
        (object) $this->logger = $logger;
        (object) $this->fileService = $fileService;
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
        DB::beginTransaction();
        try {
            $filename = $this->fileService->uploadFile($data['preview_image'], '/img/categories/');
            $path = 'img/categories/' . $filename;
            $data['preview_image'] = $path;
            $this->category::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();

        if ($category) {
            try {
                if (isset($data['preview_image'])) {
                    $filename = $this->fileService->uploadFile($data['preview_image'], '/img/categories/');
                    $path = 'img/categories/' . $filename;
                    $data['preview_image'] = $path;
                }
                $category->update($data);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
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
