<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post("register", [AuthController::class, "register"]);

    Route::post("/verify-email", [AuthController::class, "validateUserAccount"]);

    Route::post("/password-forgotten", [AuthController::class, "passwordForgotten"]);

    Route::post("/reset-password", [AuthController::class, "changePasswordWithCode"]);

    Route::post("/login", [AuthController::class, "login"]);

    Route::post("/request-code", [AuthController::class, "requestValidationCode"]);

    Route::post('/logout', [AuthController::class, "logout"])
        ->middleware(["auth:sanctum"]);

    Route::post('/change-password', [AuthController::class, "ResetPassword"])
        ->middleware(["auth:sanctum"]);
});
