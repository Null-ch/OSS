<?php

namespace App\Infrastructure\Interfaces;

interface OrderInterface
{
    /**
     * getOrder
     *
     * @return object|null
     */
    public function getOrder(int $id): ?object;

    /**
     * createOrder
     *
     */
    public function createOrder(array $data);

    /**
     * deleteOrder
     *
     * @return string|null
     */
    public function deleteOrder(int $id): ?string;

    /**
     * cancelOrder
     *
     * @param  int $id
     * @return string
     */
    public function cancelOrder(int $id): ?string;
}
