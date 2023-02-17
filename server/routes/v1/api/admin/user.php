<?php

use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('admin.user.show');
    Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
    Route::put('/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});
