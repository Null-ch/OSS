<?php

namespace App\Infrastructure\Interfaces;

interface CartProductInterface
{    
    /**
     * getCartProduct
     *
     * @param  int $id
     * @return object
     */
    public function getCartProduct(int $id): ?object;    
    /**
     * createCartProduct
     *
     * @param  int $id
     * @return string
     */
    public function createCartProduct(int $id): ?string;    
    /**
     * updateCartProduct
     *
     * @param  int $id
     * @return string
     */
    public function updateCartProduct(int $id): ?string;    
    /**
     * deleteCartProduct
     *
     * @param  int $id
     * @return string
     */
    public function deleteCartProduct(int $id): ?string;
}
