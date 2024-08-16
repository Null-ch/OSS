<?php

namespace App\Listeners;

use App\Events\OrderCompleteEvent;
use Illuminate\Support\Facades\DB;
use App\Infrastructure\Interfaces\LogInterface;

class OrderCompleteListener
{
    /**
     * LogInterface implementation
     *
     * @var object
     */
    protected $logger;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LogInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCompleteEvent $event): void
    {
        DB::beginTransaction();
        try {
            $cart = $event->cart;
            $cart->order_id = $event->orderId;
            $cart->user_id = $event->userId;
            $cart->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error("{$e->getMessage()}" . $e->getTrace());
        }
    }
}
