<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(RentController::class)->group(function () {
    Route::get('/', 'home')->name('home');

    Route::prefix('rent')->name('rent.')->group(function () {
        Route::get('{car}', 'detail')->name('detail');
    });
});

Route::prefix('auth')->group(function () {
    Route::redirect('/', '/auth/login')->name('auth');

    Route::name('auth.')->controller(AuthController::class)->middleware('guest')->group(function () {
        Route::prefix('login')->group(function () {
            Route::get('/', 'login')->name('login');
            Route::post('/', 'authenticate')->name('authenticate');
        });

        Route::prefix('register')->group(function () {
            Route::get('/', 'registration')->name('registration');
            Route::post('/', 'register')->name('register');
        });

        Route::any('/logout', 'logout')->withoutMiddleware('guest')->middleware('auth')->name('logout');
    });
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('customers', CustomerController::class)->except(['show']);
    Route::resource('brands', BrandController::class)->except(['show']);
    Route::resource('cars', CarController::class)->except(['show']);
    Route::resource('orders', OrderController::class)->except(['show']);
});
