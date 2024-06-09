<?php

use Illuminate\Support\Facades\Route;

Route::match(['get','post'],'/registration',[\App\Http\Controllers\MainController::class, 'registration']);

Route::match(['get','post'],'/login',[\App\Http\Controllers\MainController::class, 'login']);

Route::middleware('auth:sanctum')->get('/logout',[\App\Http\Controllers\MainController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/token/remove',[\App\Http\Controllers\MainController::class, 'tokens_remove']);

Route::middleware('auth:sanctum')->get('/token/get',[\App\Http\Controllers\MainController::class, 'tokens_get']);

Route::middleware('auth:sanctum')->get('/',[\App\Http\Controllers\MainController::class, 'home']);
    