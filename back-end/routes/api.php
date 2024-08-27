<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::prefix('product')->group(function() {
    Route::get('', [ProductController::class, 'get']);
    Route::get('detail/{id}', [ProductController::class, 'getDetailProduct']);
    Route::get('priceSort', [ProductController::class, 'getByPrice']);
    Route::get('filterByCategory/{id}', [ProductController::class, 'filterByCategory']);
    Route::post('', [ProductController::class, 'create']);
    Route::put('', [ProductController::class, 'edit']);    
});

Route::prefix('category')->group(function() {
    Route::get('', [CategoryController::class, 'get']);
    Route::get('{id}', [CategoryController::class, 'get_detail']);
    Route::post('', [CategoryController::class, 'create']);
    Route::put('', [CategoryController::class, 'edit']);
    Route::delete('{id}', [CategoryController::class, 'delete']);
});