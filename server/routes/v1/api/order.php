<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('order.index');
    Route::get('/{order_code}', [OrderController::class, 'show'])->name('order.show');
});
