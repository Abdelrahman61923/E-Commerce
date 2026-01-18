<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\MyAccountController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\WishController;
use App\Http\Controllers\Front\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;


Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/','index')->name('home');
    Route::get('/about-us','about')->name('about.index');
    Route::get('/contact-us','contact')->name('contact.index');
    Route::post('/contact-us/store','store')->name('contact.store');
    Route::get('/search','search')->name('home.search');
});

Route::controller(ShopController::class)->group(function () {
    Route::get('/shop','index')->name('shop.index');
    Route::get('/shop/{product:slug}','show')->name('shop.show');
});

Route::controller(CartController::class)
    ->prefix('cart')->name('cart.')->group(function () {
        Route::get('/','index')->name('index');
        Route::post('/add','add')->name('add');
        Route::put('/increase-quantity/{rowId}','increase_cart_quantity')->name('qty.increase');
        Route::put('/decrease-quantity/{rowId}','decrease_cart_quantity')->name('qty.decrease');
        Route::delete('/remove/{rowId}','remove_item')->name('item.remove');
        Route::delete('/clear','empty_cart')->name('empty');
        Route::post('/apply-coupon','apply_coupon_code')->name('coupon.apply');
        Route::delete('/remove-coupon','remove_coupon_code')->name('coupon.remove');
});

Route::controller(WishlistController::class)
    ->prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/','index')->name('index');
        Route::post('/add/{product}','add_to_wishlist')->name('add');
        Route::delete('/remove/{product}','remove_item')->name('item.remove');
        Route::delete('/clear','empty_wishlist')->name('empty');
        Route::post('/move-to-cart/{product}','move_to_cart')->name('move.to.cart');
});

Route::controller(CheckoutController::class)
    ->name('order.')->group(function () {
        Route::get('/checkout','checkout')->name('checkout');
        Route::post('/order/place','place_an_order')->name('place');
        Route::get('/order/confirmation/{order}','order_confirmation')->name('confirmation');
});

Route::middleware('auth')->controller(MyAccountController::class)
    ->name('user.')->group(function () {
        Route::get('/my-account','index')->name('index');
        Route::get('/account-orders','orders')->name('orders');
        Route::get('/account-order/{order}/details','order_details')->name('orders.details');
        Route::put('/account-order/canceled/{order}','update_order_status')->name('orders.update');
});

require __DIR__.'/dashboard.php';
