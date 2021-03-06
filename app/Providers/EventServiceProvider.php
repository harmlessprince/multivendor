<?php

namespace App\Providers;

use App\Events\OrderPaidEvent;
use App\Events\OrderPlacedEvent;
use App\Events\ShopCreatedEvent;
use App\Listeners\OrderPlacedListener;
use App\Listeners\SendMailOrderPaidNotification;
use App\Listeners\ShopActviationRequestListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // OrderPlacedEvent::class => [
        //     // OrderPlacedListener::class,
        //     SendMailOrderPaidNotification::class,
        // ],
        OrderPaidEvent::class => [
            SendMailOrderPaidNotification::class,
        ],
        ShopCreatedEvent::class =>[
            ShopActviationRequestListener::class,
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
