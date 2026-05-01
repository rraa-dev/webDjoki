<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\OrderController;

// Public routes (tidak perlu auth)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (perlu JWT token)
Route::middleware('auth:api')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Customer routes
    Route::apiResource('customers', CustomerController::class);

    // Hero routes
    Route::apiResource('heroes', HeroController::class);

    // Order routes
    Route::apiResource('orders', OrderController::class);
});
