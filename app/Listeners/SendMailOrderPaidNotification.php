<?php

namespace App\Listeners;

use App\Events\OrderPaidEvent;
use App\Models\User;
use App\Notifications\OrderPaidNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailOrderPaidNotification
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
    public function handle(OrderPaidEvent $event)
    {
        //
        $event->order->user->notify( new OrderPaidNotification($event->order));
    }
}
