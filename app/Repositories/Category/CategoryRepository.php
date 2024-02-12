<?php

namespace App\Repositories\Category;

interface CategoryRepository
{
    /**
     * Getting product categories
     *
     * @return object
     * 
     */
    public function getAllCategories(): object;
}
