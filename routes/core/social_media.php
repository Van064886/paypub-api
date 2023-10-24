<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'social-medias'], function () {
    Route::get('', function () {
        $datas = DB::table('social_medias')->get();
        return response()->json($datas);
    });
});
