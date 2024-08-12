<?php

namespace App\Infrastructure\Factories\Resources\Payments;

use YooKassa\Client;
use App\Infrastructure\Interfaces\PaymentInterface;
use Illuminate\Support\Facades\Log;

class YooKassa implements PaymentInterface
{
    /**
     * Method pay
     *
     * @param array $data
     *
     * @return string
     */
    public function pay(array $data): string
    {
        try {
            $client = $this->getClient();
            $idempotenceKey = uniqid('', true);
            $paymentData = $this->preparePaymentData($data);
            $response = $client->createPayment($paymentData, $idempotenceKey);
            $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
            return $confirmationUrl;
        } catch (\Exception $e) {
            Log::error('Error when create payment: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Method preparePaymentData
     *
     * @param array $data
     *
     * @return array
     */
    public function preparePaymentData(array $data): array
    {
        return [
            'amount' => [
                'value' => '1000.00',
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'locale' => 'ru_RU',
                'return_url' => 'https://merchant-site.ru/return_url',
            ],
            'capture' => true,
            'description' => 'Заказ №72',
            'metadata' => [
                'orderNumber' => 1001
            ],
            'receipt' => [
                'customer' => [
                    'full_name' => 'Ivanov Ivan Ivanovich',
                    'email' => 'email@email.ru',
                    'phone' => '79211234567',
                    'inn' => '6321341814'
                ],
                'items' => [
                    [
                        'description' => 'Переносное зарядное устройство Хувей',
                        'quantity' => '1.00',
                        'amount' => [
                            'value' => 1000,
                            'currency' => 'RUB'
                        ],
                        'vat_code' => '2',
                        'payment_mode' => 'full_payment',
                        'payment_subject' => 'commodity',
                        'country_of_origin_code' => 'CN',
                        'product_code' => '44 4D 01 00 21 FA 41 00 23 05 41 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 12 00 AB 00',
                        'customs_declaration_number' => '10714040/140917/0090376',
                        'excise' => '20.00',
                        'supplier' => [
                            'name' => 'string',
                            'phone' => 'string',
                            'inn' => 'string'
                        ]
                    ],
                ]
            ]
        ];
    }

    /**
     * Method getClient
     *
     * @return Client
     */
    public function getClient(): ?Client
    {
        $client = new Client();
        $shopId = config('yoo_kassa_shop_id');
        $token = config('yoo_kassa_token');
        $client->setAuth($shopId, $token);
        return $client;
    }
 
    /**
     * Method getPaymentInfo
     *
     * @param string $paymentId
     *
     * @return object
     */
    public function getPaymentInfo(string $paymentId): ?object
    {
        try {
            $client = $this->getClient();
            $response = $client->getPaymentInfo($paymentId);
            return $response;
        } catch (\Exception $e) {
            Log::error('Error when get payment info: ' . $e->getMessage());
            return null;
        }
    }
}
