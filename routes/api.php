<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'showOne']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/category/{id}', [CategoryController::class, 'showOne']);

Route::post('/checkout', [CheckoutController::class, 'checkout']);

Route::get('/order_history/{user_id}', [UserController::class, 'getOrdersFromUser']);
