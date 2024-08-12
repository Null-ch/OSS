<?php

namespace App\Events;

use App\Events\ProductEvent;
use Illuminate\Broadcasting\PrivateChannel;

class ProductRemovedFromCartEvent extends ProductEvent
{    
    /**
     * productId
     *
     * @var int
     */
    public $productId;

    /**
     * quantity
     *
     * @var int
     */
    public $quantity;

    public function __construct($productId, $quantity)
    {
        parent::__construct($productId, $quantity);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
