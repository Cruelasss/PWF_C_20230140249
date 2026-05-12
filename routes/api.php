<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'getToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product', [ProductApiController::class, 'store']);
});

Route::get('/product/{id}', [ProductApiController::class, 'show']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
