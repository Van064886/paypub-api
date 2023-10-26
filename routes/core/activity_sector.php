<?php

use App\Http\Controllers\API\ActivitySectorsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'activity-sectors'], function () {
    Route::get('', [ActivitySectorsController::class, "getAll"]);
});
