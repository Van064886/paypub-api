<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'API'], function () {
    require_once "core/auth.php";
    require_once "core/user.php";
    require_once "core/social_media.php";
    require_once "core/enterprise.php";
    require_once "core/activity_sector.php";
    require_once "core/advertisement.php";
    require_once "core/ads_subscription.php";
});
