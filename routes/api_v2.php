<?php

use App\Http\Controllers\Api\v2\CategoryController;
use App\Http\Controllers\Api\v2\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Orion::resource('categories', CategoryController::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('categories', CategoryController::class)
//     ->middleware('auth:sanctum');
Route::get('products', [ProductController::class, 'index']);