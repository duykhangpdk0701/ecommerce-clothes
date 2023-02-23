<?php

use App\Http\Controllers\Api\Admin\ItemController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => 'item'], function () {
    Route::get('/', [ItemController::class, 'index'])->name('admin.item.index');
    Route::post('/', [ItemController::class, 'store'])->name('admin.item.store');

});
