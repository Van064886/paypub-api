<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'middleware' => ['auth:sanctum']], function () {
    Route::get('{id}', [UserController::class, "showUser"]);

    Route::get('', [UserController::class, "searchUsersByParams"])
        ->middleware(["isAdmin"]);

    Route::put('/update-profile', [UserController::class, "updateProfile"]);

    Route::delete('', [UserController::class, "deleteUser"]);
});
