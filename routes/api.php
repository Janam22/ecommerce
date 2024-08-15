<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Middleware\AdminAuthMiddleware;

Route::post('login', [RegisterController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

// Apply Basic Auth middleware to specific routes
Route::middleware(AdminAuthMiddleware::class)->group(function () {

    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('profile', ProfileController::class);

});
