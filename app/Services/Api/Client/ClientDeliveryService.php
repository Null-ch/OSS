<?php

namespace App\Services\Api\Client;

use App\Models\Delivery;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Services\DeliveryService;

class ClientDeliveryService extends DeliveryService
{
    /**
     * Model: Delivery
     *
     * @var object
     */

    protected $delivery;

    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;

    /**
     * __construct
     *
     * @param Delivery $delivery
     * @param LogInterface $logger
     */
    public function __construct(
        Delivery $delivery,
        LogInterface $logger
    ) {
        parent::__construct($delivery, $logger);
    }
}
