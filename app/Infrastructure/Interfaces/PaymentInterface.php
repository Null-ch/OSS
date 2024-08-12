<?php

namespace App\Infrastructure\Interfaces;

interface PaymentInterface
{    
    /**
     * Method pay
     *
     * @param array $data
     *
     * @return string
     */
    public function pay(array $data): string;

    /**
     * Method preparePaymentData
     *
     * @param array $data
     *
     * @return array
     */
    public function preparePaymentData(array $data): array;

    public function getPaymentInfo(string $paymentId): ?object;
}
