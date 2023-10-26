<?php

use App\Http\Controllers\API\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'social-medias'], function () {
    Route::get('', [SocialMediaController::class, "getAll"]);
});
