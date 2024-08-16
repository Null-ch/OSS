<?php

namespace App\Infrastructure\Interfaces;

use App\Models\Order;

interface PaymentInterface
{    
    /**
     * Method pay
     *
     * @param Order $data
     *
     * @return string
     */
    public function pay(Order $data): ?string;

    /**
     * Method preparePaymentData
     *
     * @param Order $data
     *
     * @return array
     */
    public function preparePaymentData(Order $data): array;

    public function getPaymentInfo(string $paymentId): ?object;
}
