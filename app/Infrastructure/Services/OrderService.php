<?php

namespace App\Services\Admin;

use App\Models\Order;
use App\Infrastructure\Interfaces\LogInterface;
use App\Infrastructure\Interfaces\OrderInterface;

class OrderService implements OrderInterface
{
    /**
    * Model: Order
    *
    * @var object
    */
    protected $order;
    /**
    * LogInterface implementation
    *
    * @var object
    */
    protected $logger;

    /**
     * Construct order service
     *
     * @param Order $order
     * 
     */
    public function __construct(Order $order, LogInterface $logger)
    {
        (object) $this->order = $order;
        (object) $this->logger = $logger;
    }

    public function getOrder()
    {
        /* TODO:func */
    }
    public function createOrder()
    {
        /* TODO:func */
    }
}
