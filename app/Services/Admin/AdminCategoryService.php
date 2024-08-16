<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Services\FileService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\CategoryService;

class AdminCategoryService extends CategoryService
{
    /**
     * Model: Category
     *
     * @var object
     */

    protected $category;
    /**
     * LogInterface implementation
     *
     * @var object
     */

    protected $logger;

    /**
     * fileService
     *
     * @var object
     */
    protected $fileService;

    /**
     * Construct category service
     *
     * @param Category $category
     * @param LogInterface $logger
     * 
     */
    public function __construct(
        LogInterface $logger,
        Category $category,
        FileService $fileService
    ) {
        parent::__construct($logger, $category);
        (object) $this->fileService = $fileService;
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
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
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
                $this->logger->error("{$e->getMessage()}" . $e->getTrace());
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
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
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
