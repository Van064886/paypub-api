<?php

use App\Http\Controllers\API\EnterpriseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'enterprises', 'middleware' => ['auth:sanctum']], function () {
    Route::get('', [EnterpriseController::class, "allEnterprises"]);

    Route::post('', [EnterpriseController::class, "addEnterprise"]);

    Route::get('{enterprise}', [EnterpriseController::class, "getEnterprise"]);

    Route::put('{enterprise}', [EnterpriseController::class, "updateEnterprise"]);

    Route::delete('{enterprise}', [EnterpriseController::class, "deleteEnterprise"]);
});
