<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductService
{
    /**
     * Product class
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
     * ProductImage class
     *
     * @var object
     */
    private $productImage;

    /**
     * Construct product service
     *
     * @param Product $product
     * @param Category $category
     * @param ProductImage $productImage
     * 
     */
    public function __construct(Product $product, Category $category, ProductImage $productImage)
    {
        (object) $this->product = $product;
        (object) $this->category = $category;
        (object) $this->productImage = $productImage;
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

        $this->product::chunk(100, function ($results) use ($products) {
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
        return $this->product::find($id);
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
        (object) $product = $this->product::create($data);
        if (isset($images['preview_image'])) {
            $file = $images['preview_image'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img/products', $filename);
            $path = '/img/products' . $filename;
            $product->preview_image = $path;
            $product->save();
        }
        if (isset($images['product_images'])) {
            $productId = $product->id;
            $files = $images['product_images'];
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/img/products', $filename);
                $path = '/img/products' . $filename;
                $this->productImage::create(['image_path' => $path, 'product_id' => $productId]);
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
        return $this->category->getAllCategories();
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
        $this->product::destroy($id);
    }
    public function getProductImages(): array
    {
        return $this->product->images;
    }
}
