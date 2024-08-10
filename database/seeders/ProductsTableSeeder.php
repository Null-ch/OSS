<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = \App\Models\Category::all();

        foreach ($this->generateRandomProducts(100) as $productData) {
            Product::create($productData);
        }
    }

    private function generateRandomProducts(int $count): array
    {
        $products = [];

        for ($i = 0; $i < $count; $i++) {
            $products[] = [
                'title' => Str::random(10),
                'description' => Str::random(10),
                'price' => rand(100, 900),
                'category_id' => $this->getRandomCategoryId(),
                'quantity' => rand(100, 900),
                'hex_code' => '#22ce2d',
                'is_active' => 1,
                'preview_image' => 'images/soap1.jpg'
            ];
        }

        return $products;
    }

    private function getRandomCategoryId(): int
    {
        $categories = \App\Models\Category::all();
        $index = rand(0, count($categories) - 1);
        return $categories[$index]->id;
    }
}
