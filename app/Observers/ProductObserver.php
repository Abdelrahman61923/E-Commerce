<?php

namespace App\Observers;

use App\Models\User;
use App\Enums\UserType;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Enums\ProductStockStatus;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductLowStockNotification;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product): void
    {
        $product->slug = Str::slug($product->name);
    }
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the Product "updating" event.
     */
    public function updating(Product $product): void
    {
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $product->slug = Str::slug($product->name);
        if (! $product->wasChanged('quantity')) {
            return;
        }
        if ($product->quantity <= 0 && $product->stock_status !== ProductStockStatus::OUTOFSTOCK) {
            $product->update([
                'stock_status' => ProductStockStatus::OUTOFSTOCK,
            ]);
            $users = User::where('type', '=', UserType::ADMIN)->get();
            Notification::send($users, new ProductLowStockNotification($product));

            return;
        }
        if ($product->isLowStock()) {
            $users = User::where('type', '=', UserType::ADMIN)->get();
            Notification::send($users, new ProductLowStockNotification($product));
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
