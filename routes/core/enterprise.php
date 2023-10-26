<?php

use App\Http\Controllers\API\EnterpriseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'enterprises'], function () {
    Route::post('', [EnterpriseController::class, "addEnterprise"])
        ->middleware(["auth:sanctum"]);

    // Route::get('', [EnterpriseController::class, "searchUsersByParams"])
    //     ->middleware(["auth:sanctum", "isAdmin"]);

    // Route::put('/update-profile', [EnterpriseController::class, "updateProfile"])
    //     ->middleware(["auth:sanctum"]);

    // Route::delete('', [EnterpriseController::class, "deleteUser"])
    //     ->middleware(["auth:sanctum"]);
});
