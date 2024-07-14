<?php

namespace App\Services\Api\Client;

use App\Models\SpecialOffer;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\SpecialOfferService;

class ClientSpecialOfferService extends SpecialOfferService
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
        parent::__construct($specialOffer, $logger);
    }
}
