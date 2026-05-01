<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\CustomerWebController;
use App\Http\Controllers\Web\HeroWebController;
use App\Http\Controllers\Web\OrderWebController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (Laravel UI)
Auth::routes();

// Protected routes (need login)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customers
    Route::resource('customers', CustomerWebController::class);

    // Heroes
    Route::resource('heroes', HeroWebController::class);

    // Orders
    Route::resource('orders', OrderWebController::class);
});
