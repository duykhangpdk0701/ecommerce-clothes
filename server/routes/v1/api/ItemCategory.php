<?php

use App\Http\Controllers\Api\ItemCategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-category'], function () {
    Route::get('/', [ItemCategoryController::class, 'index'])->name('item-category.index');
});
