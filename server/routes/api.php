<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace(env("BASE_API"))->name('api.')->middleware(['api'])->group(function () {
    Route::group(['middleware' => ['api_key']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', [LoginController::class, 'login'])->name('login');
            Route::post('register', [RegisterController::class, 'register'])->name('register');

            // Social media login
            Route::post('oauth/{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
        });


        Route::group(['prefix' => 'v1'], function () {
            include('v1/api/brand.php');
            include('v1/api/destination.php');
            include('v1/api/address.php');
            include('v1/api/itemPersonType.php');
            include('v1/api/itemCategory.php');
            include('v1/api/itemColor.php');
            include('v1/api/itemSize.php');
            include('v1/api/itemPrice.php');
            include('v1/api/item.php');
        });
    });

    //Authenticated Routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Auth routes
        Route::get('auth/user', [UserController::class, 'user'])->name('user');
        Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'v1', 'middleware' => ['api_key']], function () {
            // include('v1/backend.php');
            include('v1/api/user.php');
            include('v1/api/cart.php');
            include('v1/api/address.php');
            include('v1/api/order.php');

            include('v1/api/admin.php');
        });
    });
});

