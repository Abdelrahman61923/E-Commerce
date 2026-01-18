<?php

namespace App\Listeners;

use App\Models\Order;
use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeductProductQuantity
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
        $order = Order::with('orderItems.product')->find($event->order->id);

        foreach ($order->orderItems as $item) {
            $item->product->decrement('quantity', $item->quantity);
        }
    }
}
