<?php

namespace App\Infrastructure\Interfaces;

interface SpecialOfferInterface
{
    public function getSpecialOfferById(int $id): ?object;

    public function getSpecialOffers(int $count): ?object;
}
