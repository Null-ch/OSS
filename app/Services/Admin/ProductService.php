<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\Category\CategoryRepository;

class ProductService
{
    /**
     * CategoryRepository
     *
     * @var object
     */
    private $categoryRepository;

    /**
     *
     * @param CategoryRepository $categoryRepository
     * 
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * All categories
     *
     * @var array
     */
    protected $allCategories;
    /**
     * Getting products
     *
     * @return object
     * 
     */
    public function getProducts(): object
    {
        $products = collect();

        Product::chunk(100, function ($results) use ($products) {
            foreach ($results as $product) {
                $products->push($product);
            }
        });
        return (object) $products;
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
        return Product::find($id);
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
        (object) $product = Product::create($data);
        if (isset($images['preview_image'])) {
            $file = $images['preview_image'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img', $filename);
            $path = 'storage/img/' . $filename;
            $product->preview_image = $path;
            $product->save();
        }
        if (isset($images['product_images'])) {
            $productId = $product->id;
            $files = $images['product_images'];
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/img', $filename);
                $path = 'storage/img/' . $filename;
                ProductImage::create(['image_path' => $path, 'product_id' => $productId]);
            }
        }
        return (object) $product;
    }
    /**
     * Getting product categories
     *
     * @return array
     * 
     */
    public function getAllCategories(): object
    {
        return $this->categoryRepository->getAllCategories();
    }
    /**
     * Delete current product
     *
     * @param int $id
     * 
     * @return [type]
     * 
     */
    public function destroy(int $id)
    {
        Product::destroy($id);
    }
}
