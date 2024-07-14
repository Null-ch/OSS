<?php

namespace App\Listeners;

use App\Models\Product;
use App\Events\ProductAddedToCart;
use App\Events\ProductRemovedFromCart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductAddedToCart $event)
    {
        $product = Product::find($event->productId);
        if ($product) {
            if ($event instanceof ProductAddedToCart) {
                $product->quantity -= $event->quantity;
            } elseif ($event instanceof ProductRemovedFromCart) {
                $product->quantity += $event->quantity;
            }
            $product->save();
        }
    }
}
