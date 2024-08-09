<?php

namespace App\Infrastructure\Interfaces;

interface UserShippingInformationInterface
{    
    /**
     * createUserShippingInformation
     *
     * @param  array $data
     * @param  int $userId
     * @return object
     */
    public function createUserShippingInformation(array $data, int $userId): ?object;

    /**
     * deleteUserShippingInformation
     *
     * @param int $id
     * @return string
     */
    public function deleteUserShippingInformation(int $id): ?string;
}
