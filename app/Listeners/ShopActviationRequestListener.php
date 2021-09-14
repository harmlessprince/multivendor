<?php

namespace App\Listeners;

use App\Events\ShopCreatedEvent;
use App\Mail\ShopActivationRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ShopActviationRequestListener
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
    public function handle(ShopCreatedEvent $event)
    {
        Mail::to($admins)->send(new ShopActivationRequest($event->shop));
    }
}
