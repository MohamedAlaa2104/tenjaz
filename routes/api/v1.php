<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;

Route::post('register', [AuthController::class, 'register'])->middleware('guest');

Route::post('login', [AuthController::class, 'login'])->middleware('guest');

Route::apiResource('users', UserController::class)->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');


