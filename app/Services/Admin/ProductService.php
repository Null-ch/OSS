<?php

namespace App\Services\Admin;

use App\Models\Product;

class ProductService
{
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

    public function getProduct(int $id)
    {
        return Product::find($id);
    }
}
