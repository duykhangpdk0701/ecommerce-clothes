<?php

use App\Http\Controllers\Api\Admin\ItemSizeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-size'], function () {
    Route::get('/', [ItemSizeController::class, 'index'])->name('admin.item-size.index');
    Route::get('/{id}', [ItemSizeController::class, 'show'])->name('admin.item-size.show');
    Route::post('/', [ItemSizeController::class, 'store'])->name('admin.item-size.store');
    Route::put('/{item-size}', [ItemSizeController::class, 'update'])->name('admin.item-size.update');
    Route::delete('/{item-size}', [ItemSizeController::class, 'destroy'])->name('admin.item-size.destroy');
});
