<?php

namespace App\Infrastructure\Interfaces;

interface ProductInterface
{    
    /**
     * getProducts
     *
     * @param  int $count
     * @return object
     */
    public function getProducts(int $count): ?object;   

    /**
     * getProduct
     *
     * @param  int $id
     * @return object
     */
    public function getProduct(int $id): ?object;
    
}
