<?php

namespace App\Infrastructure\Interfaces;

interface SpecialOfferInterface
{
    /**
     * getSpecialOfferById
     *
     * @param  int $id
     * @return object
     */
    public function getSpecialOfferById(int $id): ?object;

    /**
     * getSpecialOffers
     *
     * @param  int $count
     * @return object
     */
    public function getSpecialOffers(int $count): ?object;
}
