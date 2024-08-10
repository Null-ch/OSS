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
     * clearCart
     *
     * @param  int $id
     * @return string
     */
    public function clearCart(int $id): ?string;
}
