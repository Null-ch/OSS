<?php

namespace App\Infrastructure\Interfaces;

interface UserInterface
{
    /**
     * getUsers
     *
     * @param  int $count
     * @return object
     */
    public function getUsers(int $count): ?object;

    /**
     * getRoles
     *
     * @return array
     */
    public function getRoles(): ?array;

    /**
     * getGenders
     *
     * @return array
     */
    public function getGenders(): ?array;

    /**
     * getGender
     *
     * @return string
     */
    public function getGender(): ?string;

    /**
     * getUser
     *
     * @param  int $id
     * @return object
     */
    public function getUser(int $id): ?object;

    /**
     * createUser
     *
     * @param  int $id
     * @return object
     */
    public function createUser(array $data): ?object;
}
