<?php

namespace App\Listeners;

use App\Models\Product;
use App\Events\ProductEvent;
use Illuminate\Support\Facades\DB;
use App\Events\ProductAddedToCartEvent;
use App\Events\ProductRemovedFromCartEvent;
use App\Infrastructure\Interfaces\LogInterface;

class UpdateProductQuantityListener
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
    public function handle(ProductEvent $event): void
    {
        DB::beginTransaction();
        try {
            $product = Product::find($event->productId);
            if ($product) {
                if ($event instanceof ProductAddedToCartEvent) {
                    if ($product->quantity >= $event->quantity) {
                        $product->quantity -= $event->quantity;
                    }
                } elseif ($event instanceof ProductRemovedFromCartEvent) {
                    $product->quantity += $event->quantity;
                }
                $product->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logger->error('Error when delete the cartProduct object: ' . $e->getMessage());
        }
    }
}
