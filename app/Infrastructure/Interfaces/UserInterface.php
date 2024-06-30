<?php

namespace App\Infrastructure\Interfaces;

interface UserInterface
{
    public function getUsers(int $count): ?object;
    public function getRoles(): ?array;
    public function getGenders(): ?array;
    public function getGender(): ?string;
    public function getUser(int $id): ?object;

}
