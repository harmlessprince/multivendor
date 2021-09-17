<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ShopCreatedEvent;
use App\Mail\ShopActivationRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $admins = User::role('super-admin')->get();

        Mail::to($admins)->send(new ShopActivationRequest($event->shop));
    }
}
