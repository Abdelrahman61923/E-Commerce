<?php

use App\Http\Controllers\Front\ShopController;
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

require __DIR__.'/dashboard.php';
