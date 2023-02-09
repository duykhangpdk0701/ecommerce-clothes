<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BrandController;

Route::group(['prefix' => 'brand'], function () {
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
});
