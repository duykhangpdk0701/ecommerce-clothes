<?php

use App\Http\Controllers\Api\Admin\ItemController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => 'item'], function () {
    Route::get('/', [ItemController::class, 'index'])->name('admin.item.index');
    Route::post('/', [ItemController::class, 'store'])->name('admin.item.store');

    Route::put('/{item}/toggle-featured', [ItemController::class, 'toggleFeatured'])->name('item.toggle_featured');
    Route::put('/{item}/toggle-status', [ItemController::class, 'toggleStatus'])->name('item.toggle_status');
    Route::put('/{item}/toggle-media-type', [ItemController::class, 'toggleMediaType'])->name('item.toggle_media_type');
});
