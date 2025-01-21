<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDiscountController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/product/detail/{id}', [HomepageController::class, 'detail'])->name('product.detail');

// auth routes
Route::prefix('auth')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/post-login', [AuthController::class, 'post_login'])->name('post_login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post_register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// product routes
Route::group(['middleware' => ['role:admin']], function() {
    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });
});

// discount routes
Route::group(['middleware' => ['role:admin']], function() {
    Route::prefix('discount')->group(function (){
        Route::get('/', [DiscountController::class, 'index'])->name('discount.index');
        Route::get('/create', [DiscountController::class, 'create'])->name('discount.create');
        Route::post('/store', [DiscountController::class, 'store'])->name('discount.store');
        Route::get('/edit/{id}', [DiscountController::class, 'edit'])->name('discount.edit');
        Route::put('/update/{id}', [DiscountController::class, 'update'])->name('discount.update');
        Route::delete('/delete/{id}', [DiscountController::class, 'delete'])->name('discount.delete');
        
    });
});

// add cart discount
Route::prefix('product')->group(function (){
    Route::post('/use-discount', [CartDiscountController::class, 'use_discount'])->name('discount.use');
    Route::delete('/remove-discount', [CartDiscountController::class, 'remove_discount'])->name('discount.remove');
});

// cart routes
Route::group(['middleware' => ['role:customer']], function() {
    Route::prefix('cart')->group(function() {
        Route::post('/store/{id}', [CartController::class, 'store'])->name('cart.store');
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::delete('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
        // Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });
});

// order routes
Route::group(['middleware' => ['role:customer|admin']], function() {
    Route::prefix('order')->group(function(){
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('order.detail');
    });
});
