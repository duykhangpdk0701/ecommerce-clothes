<?php

use App\Http\Controllers\Api\ItemPersonTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-person-type'], function () {
    Route::get('/', [ItemPersonTypeController::class, 'index'])->name('item-person-type.index');
});
