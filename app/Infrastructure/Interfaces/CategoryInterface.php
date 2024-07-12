<?php

namespace App\Infrastructure\Interfaces;

interface CategoryInterface
{    
    /**
     * getCategories
     *
     * @param  int $count
     * @return object
     */
    public function getCategories(int $count): ?object;
        
    /**
     * getCategory
     *
     * @param  int $id
     * @return object
     */
    public function getCategory(int $id): ?object;

}
