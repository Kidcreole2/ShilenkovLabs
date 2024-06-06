<?php

use Illuminate\Support\Facades\Route;

Route::get('/info',[\App\Http\Controllers\InfoController::class, 'index']);

Route::get('/info/server',[\App\Http\Controllers\InfoController::class, 'server']);

Route::get('/info/client',[\App\Http\Controllers\InfoController::class, 'client']);

Route::get('/info/database',[\App\Http\Controllers\InfoController::class, 'database']);
