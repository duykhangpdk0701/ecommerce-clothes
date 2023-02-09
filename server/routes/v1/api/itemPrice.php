<?php

use App\Http\Controllers\Api\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('item-price-ranges', [ItemController::class, 'getPriceRange'])->name('item.price-range');
