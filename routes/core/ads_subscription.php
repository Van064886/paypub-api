<?php

use App\Http\Controllers\API\AdsSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'subscriptions', 'middleware' => ['auth:sanctum']], function () {
    Route::get('', [AdsSubscriptionController::class, "allSubscriptions"])->middleware(['isAdmin']);

    Route::post('', [AdsSubscriptionController::class, "addSubscription"]);

    Route::get('{adsSubscription}', [AdsSubscriptionController::class, "getSubscription"]);

    Route::delete('{adsSubscription}', [AdsSubscriptionController::class, "deleteSubscription"]);
});
