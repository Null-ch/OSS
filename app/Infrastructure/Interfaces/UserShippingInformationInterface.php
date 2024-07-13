<?php

namespace App\Infrastructure\Interfaces;

interface UserShippingInformationInterface
{    
    /**
     * createUserShippingInformation
     *
     * @param  string $string
     * @param  int $userId
     * @return object
     */
    public function createUserShippingInformation(string $string, int $userId): ?object;

    /**
     * deleteUserShippingInformation
     *
     * @param int $id
     * @return string
     */
    public function deleteUserShippingInformation(int $id): ?string;
}
