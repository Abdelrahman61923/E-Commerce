<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;


Auth::routes();

Route::controller(HomeController::class)->group(function () {
    Route::get('/','index')->name('home');
    Route::get('/my-account','account')->name('account');
});


require __DIR__.'/dashboard.php';
