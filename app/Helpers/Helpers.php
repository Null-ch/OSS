<?php

namespace App\Helpers;

class Helpers
{
    public static function prepareOrderData(array $data, int $userId, int $userShippingInformationId, int $userDetailsId): array
    {
        return [
            'user_id' => $userId,
            'cart_id' => $data['cart_id'],
            'status' => 0,
            'user_shipping_information_id' => $userShippingInformationId,
            'user_details_id' => $userDetailsId,
        ];
    }
    public static function prepareOrderUserDetails(int $orderId, int $userDetailsId): array
    {
        return [
            'order_id' => $orderId,
            'user_details_id' => $userDetailsId,
        ];
    }
}
