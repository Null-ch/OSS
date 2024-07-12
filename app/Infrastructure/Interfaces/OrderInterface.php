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
     * @return string|null
     */
    public function createOrder(array $data): ?string;
    /**
     * deleteOrder
     *
     * @return string|null
     */
    public function deleteOrder(int $id): ?string;
}
