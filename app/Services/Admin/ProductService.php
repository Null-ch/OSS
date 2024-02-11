<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Models\ProductImage;

class ProductService
{
    /**
     * Getting products
     *
     * @return object
     * 
     */
    public function getProducts()
    {
        $products = collect();

        Product::chunk(100, function ($results) use ($products) {
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
    public function getProduct(int $id)
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
    public function createProduct(array $data, array $images)
    {
        $product = Product::create($data);
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
        return $product;
    }
}
