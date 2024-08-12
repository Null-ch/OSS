<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
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
        $this->productId = $productId;
        $this->quantity = $quantity;
    }
}
