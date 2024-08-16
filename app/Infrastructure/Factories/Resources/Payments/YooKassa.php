<?php

namespace App\Infrastructure\Factories\Resources\Payments;

use YooKassa\Client;
use App\Infrastructure\Interfaces\PaymentInterface;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class YooKassa implements PaymentInterface
{
    /**
     * Method pay
     *
     * @param Order $order
     *
     * @return string
     */
    public function pay(Order $order): ?string
    {
        try {
            $client = $this->getClient();
            $idempotenceKey = uniqid('', true);
            $paymentData = $this->preparePaymentData($order);
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
     * @param Order $order
     *
     * @return array
     */
    public function preparePaymentData(Order $order): array
    {
        return 
        [
            'amount' => [
                'value' => 10000,
                'currency' => 'RUB'
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => env("APP_URL") . '/order/sucsess',
            ],
            'description' => $order->id,
            'test' => true,
            // 'receipt' => [
            //     'customer' => [
            //         'email' => $order->user->email,
            //     ],
            //     'items' => [
            //         [
            //             'description' => 'Подписка',
            //             'amount' => [
            //                 'value' => '150.0',
            //                 'currency' => 'RUB'
            //             ],
            //             'vat_code' => '6',
            //             'quantity' => '1',
            //         ]
            //     ]
            // ],
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
        $shopId = config('app.yoo_kassa_shop_id');
        $token = config('app.yoo_kassa_token');
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
