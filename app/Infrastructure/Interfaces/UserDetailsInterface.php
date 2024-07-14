<?php

namespace App\Infrastructure\Interfaces;

interface UserDetailsInterface
{    
    /**
     * createUserDetails
     *
     * @param  array $data
     * @param  int $userId
     * @return object
     */
    public function createUserDetails(array $data, int $userId): ?object;

    /**
     * deleteUserDetails
     *
     * @param  int $id
     * @return string
     */
    public function deleteUserDetails(int $id): ?string;
}
