<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\APIController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\VendorUserController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductVarientController;

Route::controller(CustomerRegisterController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::controller(AdminLoginController::class)->group(function(){
    Route::post('adminlogin', 'login');
});

// Apply Admin Auth middleware to specific routes
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('profile', ProfileController::class);
    Route::apiResource('sourceapi', APIController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('vendorusers', VendorUserController::class);
    Route::apiResource('colors', ColorController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('productvarient', ProductVarientController::class);

});

