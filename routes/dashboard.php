<?php

use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SlideController;
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
    Route::resource('/slides', SlideController::class);

    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders','index')->name('orders.index');
        Route::get('/order/{order}/details','show')->name('orders.show');
        Route::put('/order/{order}','update_order_status')->name('orders.update');
    });
});
