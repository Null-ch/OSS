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
     * @param  object $cart
     * @param  object $product
     * @return string
     */
    public function deleteCartProduct(object $cart, object $product): ?string;

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
