<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/cart/adjust-qty/{id}', [CartController::class, 'adjust_quantity'])->name('cart.adjust_qty');
