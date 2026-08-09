<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;

// --- Auth (public) ---
Route::post('/register', [AuthController::class, 'apiRegister']);
Route::post('/login', [AuthController::class, 'apiLogin']);

// --- Auth (requires a valid token) ---
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'apiLogout']);
    Route::get('/me', [AuthController::class, 'apiMe']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function () {
    return ['name' => 'John ', 'email' => 'john@example.com'];
});

// --- Products (public for now) ---
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
