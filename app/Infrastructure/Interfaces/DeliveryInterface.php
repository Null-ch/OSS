<?php

namespace App\Infrastructure\Interfaces;

interface DeliveryInterface
{
    /**
     * getDelivery
     *
     * @return object|null
     */
    public function getDelivery(int $id): ?object;

    /**
     * getDelivery
     *
     * @return object|null
     */
    public function getAllDeliveries(): ?object;
}
