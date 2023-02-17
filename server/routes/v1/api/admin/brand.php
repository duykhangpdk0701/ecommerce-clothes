<?php

use App\Http\Controllers\Api\Admin\BrandController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'brand'], function () {
    Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
    Route::get('/{id}', [BrandController::class, 'show'])->name('admin.brand.show');
    Route::post('/', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::put('/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
});
