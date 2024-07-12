<?php

namespace App\Infrastructure\Interfaces;

interface CartInterface
{
    /**
     * getCartProducts
     *
     * @return object
     */
    public function getCartProducts(): ?object;

    /**
     * getCart
     *
     * @return object
     */
    public function getCart(): ?object;

    /**
     * addProduct
     *
     * @param  array $data
     * @return string
     */
    public function addProduct(array $data): ?string;

    /**
     * updateProduct
     *
     * @param  array $data
     * @return string
     */
    public function updateProduct(array $data): ?string;

    /**
     * deleteProduct
     *
     * @param  int $id
     * @return string
     */
    public function deleteProduct(int $id): ?string;
}
