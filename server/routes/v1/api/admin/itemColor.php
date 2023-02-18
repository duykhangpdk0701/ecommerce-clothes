<?php

use App\Http\Controllers\Api\Admin\ItemColorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-color'], function () {
    Route::get('/', [ItemColorController::class, 'index'])->name('admin.item-color.index');
    Route::get('/{id}', [ItemColorController::class, 'show'])->name('admin.item-color.show');
    Route::post('/', [ItemColorController::class, 'store'])->name('admin.item-color.store');
    Route::put('/{item-color}', [ItemColorController::class, 'update'])->name('admin.item-color.update');
    Route::delete('/{item-color}', [ItemColorController::class, 'destroy'])->name('admin.item-color.destroy');
});
