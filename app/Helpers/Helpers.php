<?php

namespace App\Helpers;

use App\Models\User;

final class Helpers
{
    public function prepareOrderData(int $cartId, int $userId, int $delivery_service_id, ?int $userShippingInformationId = null, ?int $userDetailsId = null): array
    {
        return [
            'user_id' => $userId,
            'cart_id' => $cartId,
            'status' => 0,
            'user_shipping_information_id' => $userShippingInformationId,
            'user_details_id' => $userDetailsId,
            'delivery_service_id' => $delivery_service_id,
        ];
    }

    public function prepareUserDetailsData(User $user): array
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => null,
        ];
    }
}
