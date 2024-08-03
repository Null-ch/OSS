<?php

namespace App\Events;

use App\Events\ProductEvent;
use Illuminate\Broadcasting\PrivateChannel;

class ProductRemovedFromCart extends ProductEvent
{
    public $productId;
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
