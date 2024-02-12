<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;

class CategoryRepositoryEloquent  implements CategoryRepository
{
    /**
     * Getting product categories
     *
     * @return object
     * 
     */
    public function getAllCategories(): object
    {
        $categories = collect();
        Category::chunk(100, function ($results) use ($categories) {
            foreach ($results as $category) {
                $categories->push($category);
            }
        });
        return (object) $categories;
    }
}
