<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;

// Default Laravel welcome page moved to /welcome
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/post/{slug?}', function ($slug = 'default-post') {
    return "Post slug: $slug";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'Admin Users';
    });
    Route::get('/posts', function () {
        return 'Admin Posts';
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return 'User Profile';
    });
});

Route::fallback(function () {
    return response()->view('404', [], 404);
});

Route::resource('categories', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('invoices', App\Http\Controllers\InvoicesController::class);

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/list', [FrontendController::class, 'list'])->name('frontend.list');
Route::get('/show/{id}', [FrontendController::class, 'show'])->name('frontend.show');
