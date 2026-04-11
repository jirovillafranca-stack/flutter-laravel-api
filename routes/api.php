<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ApiController::class, 'profile']);
    Route::post('/order', [ApiController::class, 'order']);
    Route::get('/foods', [ApiController::class, 'getFoods']);
    Route::post('/foods', [ApiController::class, 'addFood']);
    Route::get('/profile', [ApiController::class, 'profile']);
    Route::post('/cart', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::delete('/cart', [CartController::class, 'clearCart']);
    Route::get('/cart', [CartController::class, 'myCart']);
    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/orders', [OrderController::class, 'myOrders']);
});
