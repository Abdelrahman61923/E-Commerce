<?php

use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Models\User;


Route::middleware(['auth', 'auth.type:' . User::TYPE_ADMIN])
    ->prefix('admin')->name('admin.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard','index')->name('dashboard');
    });

    Route::resource('/brands', BrandController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/coupons', CouponController::class);

    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders','index')->name('orders.index');
        Route::get('/orders/{order}','show')->name('orders.show');
    });
});
