<?php

namespace App\Infrastructure\Factories;

use App\Infrastructure\Interfaces\PaymentInterface;
use App\Infrastructure\Factories\Resources\Payments\YooKassa;

class PaymentFactory
{
    /**
     * create
     *
     * @param  string $type
     * @return PaymentInterface
     */
    public static function create(string $type): PaymentInterface
    {
        switch ($type) {
            case 'yoo_kassa':
                return new YooKassa();
            default:
                throw new \InvalidArgumentException("Неизвестный тип платежной системы: $type");
        }
    }
}
