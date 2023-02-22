<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'my-profile'], function () {
    Route::put('update', [UserController::class, 'changeProfile'])->name('user.my_profile.update');
    Route::put('change-password', [UserController::class, 'changePassword'])->name('my_profile.change_password');
    Route::put('change-address', [UserController::class, 'changeAddress'])->name('my_profile.change_address');
    Route::post('upload-avatar', [UserController::class, 'uploadAvatar'])->name('my_profile.upload_avatar');
});
