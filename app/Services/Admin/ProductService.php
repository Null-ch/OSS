<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

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
     * Construct product service
     *
     * @param Product $product
     * @param Category $category
     * 
     */
    public function __construct(Product $product, Category $category)
    {
        (object) $this->product = $product;
        (object) $this->category = $category;
    }

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

        return $product;
    }
    /**
     * Update current product
     *
     * @param array $data
     * @param array $images
     * @param int $id
     * 
     * @return object
     * 
     */
    public function updateProduct(array $data, array $images, int $id): object
    {
        $product = $this->product::find($id);
        $product->update($data);
        if ($images) {
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
        }

        return $product;
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
}
