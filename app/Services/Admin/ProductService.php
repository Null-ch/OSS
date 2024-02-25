<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Services\LogInterface;
use Illuminate\Database\Connection;

class ProductService
{
    /**
     * Model: Product
     *
     * @var object
     */

    private $product;
    /**
     * Category class
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
     * DB connection
     *
     * @var \Illuminate\Database\Connection
     */

    private $database;
    /**
     * Construct product service
     *
     * @param Product $product
     * @param Category $category
     * @param LogInterface $logger
     * @param Connection $database
     * 
     */
    public function __construct(Product $product, Category $category, LogInterface $logger, Connection $database)
    {
        (object) $this->product = $product;
        (object) $this->category = $category;
        (object) $this->logger = $logger;
        (object) $this->database = $database;
    }

    /**
     * Getting products
     *
     * @return object
     * 
     */
    public function getProducts(int $count): object
    {
        if (!$count) {
            $this->logger->error('The quantity has not been transferred.');
        }

        try {
            $products = $this->product::paginate($count);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the products: ' . $e->getMessage());
        }

        return $products;
    }

    /**
     * Get product
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getProduct(int $id): object
    {
        if (!$id) {
            $this->logger->error('The id has not been transferred.');
        }

        try {
            $product = $this->product::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error('Error when receiving the product: ' . $e->getMessage());
        }

        return $product;
    }

    /**
     * Create new product
     *
     * @param array $data
     * 
     * @return object
     * 
     */
    public function createProduct(array $data, array $images): object
    {
        if (!$data) {
            $this->logger->error('The data has not been transferred.');
        }
        if (!$images) {
            $this->logger->error('The images has not been transferred.');
        }

        try {
            $product = $this->product->create($data);

            $sortOrder = 1;

            foreach ($images as $key => $image) {
                $file = $image;
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/img/products', $filename);
                $path = 'storage/img/products/' . $filename;

                if ($key === 'preview_image') {
                    $product->preview_image = $path;
                    $product->save();
                } else {
                    $product->images()->create([
                        'image_path' => $path,
                        'sort_order' => $sortOrder,
                    ]);
                    $sortOrder++;
                }
            }
        } catch (\Exception $e) {
            $this->database->rollBack();
            $this->logger->error('Error when creating a product and loading images: ' . $e->getMessage());
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

        $product = $this->product::findOrFail($id);
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
                    $file = $images['preview_image'];
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = 'storage/img/products/' . $filename;
                    $file->storeAs('public/img/products', $filename);

                    $product->preview_image = $path;
                    $product->save();
                }

                foreach ($images as $key => $image) {
                    if ($key !== 'preview_image') {
                        $index = preg_replace('/[^0-9]/', '', $key);
                        $file = $image;
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = 'storage/img/products/' . $filename;
                        $file->storeAs('public/img/products', $filename);

                        if (isset($productImages[$index])) {
                            $productImages[$index]->update([
                                'image_path' => $path
                            ]);
                        } else {
                            $lastIndex = $productImages->count();
                            $product->images()->create([
                                'image_path' => $path,
                                'sort_order' => $lastIndex + 1,
                            ]);
                        }
                    }
                }
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
    public function getAllCategories(): object
    {
        try {
            $allCategories = $this->category->getAllCategories();
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
     * @return array
     * 
     */
    public function toggleActivity(int $id): array
    {
        $response = ['success' => true];
        $product = $this->getProduct($id);
        if ($product) {
            $product->is_active == 1 ? $product->is_active = 0 : $product->is_active = 1;
            $product->save();
    
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }

        return $response;
    }
}
