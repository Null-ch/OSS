<?php

namespace App\Services\Admin;

use App\Models\Order;

class OrderService
{
    /**
     * Model: Order
     *
     * @var object
     */
    protected $order;

    /**
     * Construct order service
     *
     * @param Order $order
     * 
     */
    public function __construct(Order $order)
    {
        (object) $this->order = $order;
    }
}
