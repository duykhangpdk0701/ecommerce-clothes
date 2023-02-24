<?php

use App\Http\Controllers\Api\Admin\ItemStockController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-stock'], function () {
    Route::get('/', [ItemStockController::class, 'index'])->name('admin.item-stock.index');
    Route::get('/{id}', [ItemStockController::class, 'show'])->name('admin.item-stock.show');
});
