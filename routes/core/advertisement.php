<?php

use App\Http\Controllers\API\AdvertisementController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'advertisements', 'middleware' => ['auth:sanctum']], function () {
    Route::get('', [AdvertisementController::class, "listAll"])->middleware(['isAdmin']);

    Route::post('', [AdvertisementController::class, "add"]);

    Route::get('{advertisement}', [AdvertisementController::class, "get"]);

    Route::put('{advertisement}', [AdvertisementController::class, "update"]);

    Route::delete('{advertisement}', [AdvertisementController::class, "delete"]);
});
