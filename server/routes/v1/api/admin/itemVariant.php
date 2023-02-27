<?php

use App\Http\Controllers\Api\Admin\ItemVariantController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-variant'], function () {
    Route::get('/', [ItemVariantController::class, 'index'])->name('admin.item-variant.index');
    Route::get('/{id}', [ItemVariantController::class, 'show'])->name('admin.item-variant.show');
    Route::get('/item/{id}', [ItemVariantController::class, 'showByItemId'])->name('admin.item-variant.showByItemId');
});
