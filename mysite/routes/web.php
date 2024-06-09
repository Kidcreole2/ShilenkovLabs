<?php

use Illuminate\Support\Facades\Route;

Route::match(['get','post'],'/registration',[\App\Http\Controllers\MainController::class, 'registration']);

Route::match(['get','post'],'/login',[\App\Http\Controllers\MainController::class, 'login']);

Route::get('/logout',[\App\Http\Controllers\MainController::class, 'logout']);

Route::get('/token/remove',[\App\Http\Controllers\MainController::class, 'tokens_remove']);

Route::get('/token/get',[\App\Http\Controllers\MainController::class, 'tokens_get']);

Route::get('/',[\App\Http\Controllers\MainController::class, 'home']);
    