<?php

use App\Http\Controllers\Api\V1\AuthController;

Route::post('register', [AuthController::class, 'register'])->middleware('guest');

Route::post('login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/user', function (Request $request) {
    return auth()->user();
})->middleware('auth:sanctum');
