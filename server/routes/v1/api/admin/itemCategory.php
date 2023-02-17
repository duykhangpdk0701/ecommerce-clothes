<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-category'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.item-category.index');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('admin.item-category.show');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.item-category.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.item-category.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.item-category.destroy');
});
