<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::Get('/users', function () {
    return ['name' => 'John ', 'email' => 'john@example.com'];
});
