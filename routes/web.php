<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/showProducts', [HomeController::class, 'showProducts'])->name('showProducts');
Route::get('search', [HomeController::class, 'search']);
Route::get('productDetails/{id}', [HomeController::class, 'productDetails']);
Route::get('searchByCategory/{category}', [HomeController::class, 'searchByCategory']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [HomeController::class, 'login'])->name('login');

    Route::get('/signup', [HomeController::class, 'signup'])->name('signup');

    Route::post('register', [HomeController::class, 'register']);

    Route::post('loginPost', [HomeController::class, 'loginPost'])->name('loginPost');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [HomeController::class, 'logout'])->name('logout');

    Route::get('addCart/{id}', [HomeController::class, 'addCart']);

    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

    Route::get('deleteCart/{id}', [HomeController::class, 'deleteCart']);

    Route::post('confirmOrder', [HomeController::class, 'confirmOrder']);

    Route::get('/order', [HomeController::class, 'order'])->name('order');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');

    Route::get('/viewCategory', [AdminController::class, 'viewCategory'])->name('viewCategory');

    Route::post('addCategory', [AdminController::class, 'addCategory']);

    Route::get('deleteCategory/{id}', [AdminController::class, 'deleteCategory']);

    Route::get('editCategory/{id}', [AdminController::class, 'editCategory']);

    Route::put('updateCategory/{id}', [AdminController::class, 'updateCategory']);

    Route::post('uploadProduct', [AdminController::class, 'uploadProduct']);

    Route::get('/viewProduct', [AdminController::class, 'viewProduct'])->name('viewProduct');

    Route::get('deleteProduct/{id}', [AdminController::class, 'deleteProduct']);

    Route::get('editProduct/{id}', [AdminController::class, 'editProduct']);

    Route::put('updateProduct/{id}', [AdminController::class, 'updateProduct']);

    Route::get('searchProduct', [AdminController::class, 'searchProduct']);

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');

    Route::get('onTheWay/{id}', [AdminController::class, 'onTheWay']);

    Route::get('delivered/{id}', [AdminController::class, 'delivered']);
});
