<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add_to_cart');
    Route::put('/plus-cart', [CartController::class, 'plusCart'])->name('cart.plus_cart');
    Route::put('/minus-cart', [CartController::class, 'minusCart'])->name('cart.minus_cart');
    Route::put('/delete-item-cart', [CartController::class, 'deleteItem'])->name('cart.delete_item_cart');
    Route::get('/get-quote-by-user', [CartController::class, 'getQuoteId'])->name('cart.get_quote_by_user');
    Route::get('/payment-method', [CartController::class, 'getPaymentMethod'])->name('cart.get_payment_method');
    Route::post('/confirm-checkout', [CartController::class, 'confirmCheckout'])->name('coupon.confirm_checkout');
});
