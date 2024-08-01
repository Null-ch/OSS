<?php

namespace App\Infrastructure\Interfaces;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;

interface CartProductInterface
{    
    /**
     * Method getCartProduct
     *
     * @param Cart $cart [explicite description]
     * @param Product $product [explicite description]
     *
     * @return CartProduct
     */
    public function getCartProduct(Cart $cart, Product $product): ?CartProduct;

    /**
     * createCartProduct
     *
     * @param  array $data
     * @return string
     */
    public function createCartProduct(array $data): ?string;

    
    /**
     * Method updateCartProduct
     *
     * @param Cart $cart [explicite description]
     * @param Product $product [explicite description]
     * @param array $data [explicite description]
     *
     * @return string
     */
    public function updateCartProduct(Cart $cart, Product $product, array $data): ?string;
    
    /**
     * Method deleteCartProduct
     *
     * @param Cart $cart [explicite description]
     * @param Product $product [explicite description]
     *
     * @return string
     */
    public function deleteCartProduct(Cart $cart, Product $product): ?string;

    /**
     * clearingByCartId
     *
     * @param  int $id
     * @return string
     */
    public function clearingByCartId(int $id): ?string;

    /**
     * getCartProductsByCartId
     *
     * @param  int $id
     * @return object
     */
    public function getCartProductsByCartId(int $id): ?object;
}
