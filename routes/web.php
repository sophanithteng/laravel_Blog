<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
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
//Route::resource('/product',ProductController::class);

Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product',[ProductController::class,'store'])->name('product.store');
Route::get('/product/{product}',[ProductController::class,'show'])->name('product.show');
Route::delete('/product/{product}',[ProductController::class,'destroy'])->name('product.destroy');
Route::get('/product/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
Route::put('/product/{product}',[ProductController::class,'update'])->name('product.update');
