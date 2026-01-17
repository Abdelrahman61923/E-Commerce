<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Order;
use App\Enums\UserType;
use App\Events\OrderCreated;
use App\Enums\ProductStockStatus;
use App\Notifications\ProductStockStatusNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

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

            if ($item->product->quantity <= 0) {
                $item->product->update([
                    'stock_status' => ProductStockStatus::OUTOFSTOCK,
                ]);
                $users = User::where('type', '=', UserType::ADMIN)->get();
                Notification::send($users, new ProductStockStatusNotification($item->product));
            }
        }
    }
}
