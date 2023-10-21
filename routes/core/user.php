<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('{id}', [UserController::class, "showUser"])
        ->middleware(["auth:sanctum"]);

    Route::get('', [UserController::class, "searchUsersByParams"])
        ->middleware(["auth:sanctum", "isAdmin"]);

    Route::put('/update-profile', [UserController::class, "updateProfile"])
        ->middleware(["auth:sanctum"]);

    Route::delete('', [UserController::class, "deleteUser"])
        ->middleware(["auth:sanctum"]);
});
