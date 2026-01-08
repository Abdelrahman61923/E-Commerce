<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;


Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/','index')->name('home');
    Route::get('/my-account','account')->name('account');
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
});

Route::controller(WishlistController::class)
    ->prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/','index')->name('index');
        Route::post('/add','add_to_wishlist')->name('add');
        Route::delete('/remove/{rowId}','remove_item')->name('item.remove');
        Route::delete('/clear','empty_wishlist')->name('empty');
        Route::post('/move-to-cart/{rowId}','move_to_cart')->name('move.to.cart');
});

require __DIR__.'/dashboard.php';
