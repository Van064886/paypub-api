<?php

use App\Http\Controllers\API\EnterpriseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'enterprises'], function () {
    Route::get('', [EnterpriseController::class, "allEnterprises"])
        ->middleware(["auth:sanctum"]);

    Route::post('', [EnterpriseController::class, "addEnterprise"])
        ->middleware(["auth:sanctum"]);

    Route::put('{enterprise}', [EnterpriseController::class, "updateEnterprise"])
        ->middleware(["auth:sanctum"]);

    Route::delete('{enterprise}', [EnterpriseController::class, "deleteEnterprise"])
        ->middleware(["auth:sanctum"]);
});
