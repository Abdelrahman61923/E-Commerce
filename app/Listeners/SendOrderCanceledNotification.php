<?php

namespace App\Listeners;

use App\Models\User;
use App\Enums\UserType;
use App\Events\OrderCanceled;
use App\Notifications\OrderCanceledNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCanceledNotification
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
    public function handle(OrderCanceled $event): void
    {
        $order = $event->order;

        $users = User::where('type', '=', UserType::ADMIN)->get();
        Notification::send($users, new OrderCanceledNotification($order));
    }
}
