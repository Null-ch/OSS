<?php

namespace App\Infrastructure\Services;

use App\Models\SpecialOffer;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\SpecialOfferInterface;

class SpecialOfferService implements SpecialOfferInterface
{
    /**
     * Model: SpecialOffer
     *
     * @var object
     */
    protected $specialOffer;

    /**
     * LogInterface implementation
     *
     * @var object
     */

    protected $logger;

    /**
     * Construct specialOffer service
     *
     * @param SpecialOffer $specialOffer
     * @param LogInterface $logger
     * 
     */
    public function __construct(
        SpecialOffer $specialOffer,
        LogInterface $logger
    ) {
        $this->specialOffer = $specialOffer;
        $this->logger = $logger;
    }

    /**
     * Get special offer by id
     *
     * @param int $id
     * 
     * @return object
     * 
     */
    public function getSpecialOfferById(int $id): ?object
    {
        try {
            $specialOffer = $this->specialOffer::findOrFail($id);
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }

        return $specialOffer;
    }

    /**
     * Getting all categories
     *
     * @param int $count
     * 
     * @return object
     * 
     */
    public function getSpecialOffers(int $count): ?object
    {
        try {
            $specialOffers = $this->specialOffer::paginate($count);
        } catch (\Exception $e) {
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
            return null;
        }

        return $specialOffers;
    }
}
