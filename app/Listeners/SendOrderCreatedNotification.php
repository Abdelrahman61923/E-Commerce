<?php

namespace App\Listeners;

use App\Enums\UserType;
use App\Models\User;
use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreatedNotification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;

        $users = User::where('type', '=', UserType::ADMIN)->get();
        Notification::send($users, new OrderCreatedNotification($order));
    }
}
