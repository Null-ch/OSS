<?php

namespace App\Providers;

use App\Events\OrderCompleteEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Events\ProductAddedToCartEvent;
use App\Listeners\OrderCompleteListener;
use App\Events\ProductRemovedFromCartEvent;
use App\Listeners\UpdateProductQuantityListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProductAddedToCartEvent::class => [
            UpdateProductQuantityListener::class,
        ],
        ProductRemovedFromCartEvent::class => [
            UpdateProductQuantityListener::class,
        ],
        OrderCompleteEvent::class => [
            OrderCompleteListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
