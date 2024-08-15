<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\APIController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Middleware\AdminAuthMiddleware;

Route::post('login', [CustomerRegisterController::class, 'login']);
Route::post('register', [CustomerRegisterController::class, 'register']);

// Apply Admin Auth middleware to specific routes
Route::middleware(AdminAuthMiddleware::class)->group(function () {

    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('profile', ProfileController::class);
    Route::apiResource('sourceapi', APIController::class);
    Route::apiResource('customers', CustomerController::class);

});

