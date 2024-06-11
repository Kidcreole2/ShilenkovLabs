<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Middleware\AuthCheck;

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

Route::prefix('auth')->group(function () {

    Route::post('login', [MainController::class, "auth"])->name('login');

    Route::post('register', [MainController::class, "registration"])->middleware(AuthCheck::class);

    Route::middleware('auth:api')->group(function () {

        Route::get('me', [MainController::class, "me"])->name('me');

        Route::post('out', [MainController::class, "out"]);

        Route::get('tokens', [MainController::class, "tokens"]);

        Route::post('out_all', [MainController::class, "outAll"]);
   });
});

Route::prefix('ref')->group(function () {

    Route::prefix('user')->group(function () {

    });
    
    Route::prefix('policy')->group(function () {

        Route::prefix('role')->group(function () {

        });

        Route::prefix('permission')->group(function () {

        });

    });
});
