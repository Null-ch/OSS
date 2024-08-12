<?php

namespace App\Events;

use App\Models\Cart;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class OrderCompleteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * cart
     *
     * @var Cart
     */
    public $cart;
 
    /**
     * orderId
     *
     * @var int
     */
    public $orderId;
 
    /**
     * userId
     *
     * @var int
     */
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cart $cart, int $orderId, int $userId)
    {
        $this->cart = $cart;
        $this->orderId = $orderId;
        $this->userId = $userId;
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
