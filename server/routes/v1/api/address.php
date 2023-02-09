<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AddressController;

Route::group(['prefix' => 'address'], function () {
    Route::post('/', [AddressController::class, 'store']);
    Route::delete('/{address}', [AddressController::class, 'destroy']);
});
