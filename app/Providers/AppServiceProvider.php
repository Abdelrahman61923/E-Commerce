<?php

namespace App\Providers;

use App\Helpers\Currency;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
        class_alias(Cart::class, 'Cart');
        class_alias(Currency::class, 'Currency');
    }
}
