<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'Admin Users';
    });
    Route::get('/posts', function () {
        return 'Admin Posts';
    });
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('registration', [AuthController::class, 'postRegistration'])->name('Register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('auth.dashboard', ['user' => Auth::user()]);
    })->name('dashboard');

    Route::get('profile/{user}', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::patch('profile/{user}', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('change-password', [AuthController::class, 'changePasswordForm'])->name('password.form');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('change.password');
});

Route::fallback(function () {
    return response('Page Not Found', 404);
});

Route::resource('categories', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('invoices', App\Http\Controllers\InvoicesController::class);

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/list', [FrontendController::class, 'list'])->name('frontend.list');
Route::get('/show/{id}', [FrontendController::class, 'show'])->name('frontend.show');
Route::get('/search', [FrontendController::class,'getBySearch']);
Route::get('/frontend/{category?}', [FrontendController::class,'getByCategory']);
