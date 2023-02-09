<?php

use App\Http\Controllers\Api\SysCityController;
use App\Http\Controllers\Api\SysDistrictController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'destination'], function () {
    Route::get('city/', [SysCityController::class, 'index'])->name('address.city.index');
    Route::get('city/{city}', [SysCityController::class, 'getDistrictsFromCity'])->name('address.district.getDistrictsFromCity');
    Route::get('district/{district}', [SysDistrictController::class, 'getWardsFromDistrict'])->name('address.ward.getWardsFromDistrict');
});
