<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AddressController;

Route::group(['prefix' => 'address'], function () {
    Route::get('/', [AddressController::class, 'getByAuthUser']);
    Route::get('/{id}', [AddressController::class, 'show']);
    Route::post('/', [AddressController::class, 'store']);
    Route::put('/{address}', [AddressController::class, 'update']);
    Route::delete('/{address}', [AddressController::class, 'destroy']);
});
