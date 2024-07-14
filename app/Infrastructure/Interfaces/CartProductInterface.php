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
    public function getCartProduct(object $cart, object $product): ?object;

    /**
     * createCartProduct
     *
     * @param  array $data
     * @return string
     */
    public function createCartProduct(array $data): ?string;

    /**
     * updateCartProduct
     *
     * @param  mixed $cart
     * @param  mixed $product
     * @param  array $data
     * @return string
     */
    public function updateCartProduct(object $cart, object $product, array $data): ?string;

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
