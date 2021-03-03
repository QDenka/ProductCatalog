<?php

use Illuminate\Support\Facades\Route;

// Controller definition
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\CategoryController;
use App\Http\Controllers\API\v1\OrderController;
use App\Http\Controllers\API\v1\CartController;
use App\Http\Controllers\API\v1\ProductController;




Route::prefix('v1')->middleware('api.check', 'sessions')->group(function () {

    // API register/login
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    
    // Categories
    Route::get('/categories/get', [CategoryController::class, 'getTree']);

    // Products
    Route::get('/products/get', [ProductController::class, 'getFiltered']);
    Route::get('/products/slug', [ProductController::class, 'getBySlug']);

    // Cart
    Route::get('/cart/show', [CartController::class, 'showProducts']);
    Route::post('/cart/add', [CartController::class, 'addProduct']);
    Route::post('/cart/delete', [CartController::class, 'deleteFrom']);
    Route::post('/cart/product/count', [CartController::class, 'editCount']);
    Route::post('/order/make', [OrderController::class, 'make']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        // Order
        Route::get('/order/get', [OrderController::class, 'get']);
    });
});
