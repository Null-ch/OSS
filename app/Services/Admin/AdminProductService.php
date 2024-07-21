<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Connection;
use App\Infrastructure\Services\FileService;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\CategoryService;
use App\Infrastructure\Services\ProductService;

class AdminProductService extends ProductService
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

    protected $category;
    /**
     * LogInterface implementation
     *
     * @var object
     */

    protected $logger;
    /**
     * DB connection
     *
     * @var \Illuminate\Database\Connection
     */

    protected $database;

    /**
     * fileService
     *
     * @var object
     */
    protected $fileService;
    protected $categoryService;

    /**
     * Construct product service
     *
     * @param Product $product
     * @param Category $category
     * @param LogInterface $logger
     * @param Connection $database
     * 
     */
    public function __construct(Product $product, LogInterface $logger, Category $category, Connection $database, FileService $fileService, CategoryService $categoryService)
    {
        parent::__construct($product, $logger);

        $this->category = $category;
        $this->database = $database;
        $this->fileService = $fileService;
        $this->categoryService = $categoryService;
    }

    /**
     * Create new product
     *
     * @param array $data
     * 
     * @return object
     * 
     */
    public function createProduct(array $data, array $images): ?object
    {
        if (!$data) {
            $this->logger->error('The data has not been transferred.');
        }
        if (!$images) {
            $this->logger->error('The images has not been transferred.');
        }

        try {
            $product = $this->product::create($data);

            $sortOrder = 1;

            foreach ($images as $key => $image) {
                if ($key === 'preview_image') {
                    $filename = $this->fileService->uploadFile($image, 'img/products/');
                    $product->preview_image = 'img/products/' . $filename;
                    $product->save();
                } else {
                    $filename = $this->fileService->uploadFile($image, 'img/products/images/');
                    $product->images()->create([
                        'image_path' => 'img/products/images/' . $filename,
                        'sort_order' => $sortOrder,
                    ]);
                    $sortOrder++;
                }
            }
            $this->database->commit();
        } catch (\Exception $e) {
            $this->database->rollBack();
            $this->logger->error('Error when creating a product and loading images: ' . $e->getMessage());
            return null;
        }

        return $product;
    }

    /**
     * Update current product
     *
     * @param array $data
     * @param array $images
     * @param int $id
     * 
     * 
     */
    public function updateProduct(array $data, array $images, int $id)
    {
        if (!$data) {
            $this->logger->error('The data has not been transferred.');
        }
        if (!$id) {
            $this->logger->error('The id has not been transferred.');
        }

        $product = $this->getProduct($id);
        if ($product) {
            try {
                $product->update($data);
            } catch (\Exception $e) {
                $this->logger->error('Error when update the product: ' . $e->getMessage());
            }
        } else {
            $this->logger->error('The product with ID ' . $id . ' was not found.');
            return;
        }

        if ($images) {
            try {
                $productImages = $product->images;

                if (isset($images['preview_image'])) {
                    $filename = $this->fileService->uploadFile($images['preview_image'], 'img/products/');
                    $product->preview_image = 'img/products/' . $filename;
                    $product->save();
                }

                foreach ($images as $key => $image) {
                    if ($key === 'preview_image') {
                        continue;
                    }

                    $index = preg_replace('/[^0-9]/', '', $key);
                    $filename = $this->fileService->uploadFile($image, 'img/products/images/');

                    if (isset($productImages[$index])) {
                        $productImages[$index]->update([
                            'image_path' => 'img/products/images/' . $filename
                        ]);
                    } else {
                        $lastIndex = $productImages->count();
                        $product->images()->create([
                            'image_path' => 'img/products/images/' . $filename,
                            'sort_order' => $lastIndex + 1,
                        ]);
                    }
                }
                $this->database->commit();
            } catch (\Exception $e) {
                $this->database->rollBack();
                $this->logger->error('Error when updating product images: ' . $e->getMessage());
            }
        }
    }

    /**
     * Getting product categories
     *
     * @return array
     * 
     */
    public function getAllCategories(): ?object
    {
        try {
            $allCategories = $this->categoryService->getAllCategories();
        } catch (\Exception $e) {
            $this->logger->error('Error when getting categories: ' . $e->getMessage());
        }

        return $allCategories;
    }

    /**
     * Delete current product
     *
     * @param int $id
     * 
     * 
     */
    public function destroy(int $id)
    {
        try {
            $this->product::destroy($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when deleting a product: ' . $e->getMessage());
        }
    }

    /**
     * Func for chenge activity of product
     *
     * @param int $id
     * 
     */
    public function toggleActivity(int $id): ?string
    {
        $product = $this->getProduct($id);
        if ($product) {
            $product->is_active == 1 ? $product->is_active = 0 : $product->is_active = 1;
            $product->save();
            return 'Активность изменена';
        } else {
            return null;
        }
    }
}
