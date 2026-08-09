<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\StoreController;

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

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [StoreController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/update-cart', [StoreController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [StoreController::class, 'remove'])->name('remove.from.cart');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('auth.dashboard', ['user' => Auth::user()]);
    })->name('dashboard');

    Route::get('profile/{user}', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::patch('profile/{user}', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('change-password', [AuthController::class, 'changePasswordForm'])->name('password.form');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('change.password');
});

Route::resource('categories', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('invoices', App\Http\Controllers\InvoicesController::class);

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/list', [FrontendController::class, 'list'])->name('frontend.list');
Route::get('/show/{id}', [FrontendController::class, 'show'])->name('frontend.show');
Route::get('/search', [FrontendController::class, 'getBySearch']);
Route::get('/frontend/categories/{category?}', [FrontendController::class, 'getByCategory'])->name('frontend.category');

Route::fallback(function () {
    return response('Page Not Found', 404);
});
