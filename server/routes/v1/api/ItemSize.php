<?php

use App\Http\Controllers\Api\ItemSizeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-size'], function () {
    Route::get('/', [ItemSizeController::class, 'index'])->name('item-size.index');
});
