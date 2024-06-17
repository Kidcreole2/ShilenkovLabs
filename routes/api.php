<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesAndPermissionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\UsersAndRolesController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Http\Request;

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

    Route::prefix('policy')->group(function () {
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, "getList"])->middleware('App\Http\Middleware\CheckRole:get-list-role');
            Route::get('/{id}', [RoleController::class, "getById"])->middleware('App\Http\Middleware\CheckRole:read-role');
            Route::post('', [RoleController::class, "create"])->middleware('App\Http\Middleware\CheckRole:create-role');
            Route::put('/{id}', [RoleController::class, "update"])->middleware('App\Http\Middleware\CheckRole:update-role');
            Route::delete('/{id}', [RoleController::class, "delete"])->middleware('App\Http\Middleware\CheckRole:delete-role');
            Route::delete('/{id}/soft', [RoleController::class, "deleteSoft"])->middleware('App\Http\Middleware\CheckRole:delete-role');
            Route::post('/{id}/restore', [RoleController::class, "restore"])->middleware('App\Http\Middleware\CheckRole:restore-role');

            Route::get('/{id}/permission', [RolesAndPermissionsController::class, 'get'])->middleware('App\Http\Middleware\CheckRole:read-role');
            Route::get('/{id}/permission/{permission_id}', [RolesAndPermissionsController::class, 'assign'])->middleware('App\Http\Middleware\CheckRole:update-role');
            Route::delete('/{id}/permission/{permission_id}', [RolesAndPermissionsController::class, 'delete'])->middleware('App\Http\Middleware\CheckRole:delete-role');
            Route::delete('/{id}/permission/{permission_id}/soft', [RolesAndPermissionsController::class, 'deleteSoft'])->middleware('App\Http\Middleware\CheckRole:delete-role');
            Route::post('/{id}/permission/{permission_id}/restore', [RolesAndPermissionsController::class, 'restore'])->middleware('App\Http\Middleware\CheckRole:restore-role');
        });

        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, "getList"])->middleware('App\Http\Middleware\CheckRole:get-list-permission');
            Route::get('/{id}', [PermissionController::class, "getById"])->middleware('App\Http\Middleware\CheckRole:read-permission');
            Route::post('', [PermissionController::class, "create"])->middleware('App\Http\Middleware\CheckRole:create-permission');
            Route::put('/{id}', [PermissionController::class, "update"])->middleware('App\Http\Middleware\CheckRole:update-permission');
            Route::delete('/{id}', [PermissionController::class, "delete"])->middleware('App\Http\Middleware\CheckRole:delete-permission');
            Route::delete('/{id}/soft', [PermissionController::class, "deleteSoft"])->middleware('App\Http\Middleware\CheckRole:delete-permission');
            Route::post('/{id}/restore', [PermissionController::class, "restore"])->middleware('App\Http\Middleware\CheckRole:restore-permission');
        });

    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, "getUsers"])->middleware('App\Http\Middleware\CheckRole:get-list-user');
        Route::get('/{id}/role', [UserController::class, "getRoles"])->middleware('App\Http\Middleware\CheckRole:read-user');
        Route::post('/{id}/role', [UsersAndRolesController::class, "assign"])->middleware('App\Http\Middleware\CheckRole:read-user');
        Route::put('{id}/updateUser', [UserController::class, 'updateUser'])->middleware('App\Http\Middleware\CheckRole:read-user');
        Route::delete('{id}/hard', [UserController::class, 'delete'])->middleware('App\Http\Middleware\CheckRole:delete-user');
        Route::delete('{id}/soft', [UserController::class, 'deleteSoft'])->middleware('App\Http\Middleware\CheckRole:delete-user');
        Route::post('{id}/restore', [UserController::class, 'restore'])->middleware('App\Http\Middleware\CheckRole:restore-user');
        Route::put('{id}/changeUserRole', [UserController::class, 'assign'])->middleware('App\Http\Middleware\CheckRole:update-user');
        Route::delete('/{id}/role/{role_id}', [UsersAndRolesController::class, "delete"])->middleware('App\Http\Middleware\CheckRole:delete-user');
        Route::delete('/{id}/role/{role_id}/soft', [UsersAndRolesController::class, "deleteSoft"])->middleware('App\Http\Middleware\CheckRole:delete-user');
        Route::post('/{id}/role/{role_id}/restore', [UsersAndRolesController::class, "restore"])->middleware('App\Http\Middleware\CheckRole:delete-user');
    });

    Route::prefix('log')->group(function () {
        Route::get('{model}/{id}/story', [LogsController::class, "getLogs"])->middleware('App\Http\Middleware\CheckRole:get-story-user');
        Route::get('{id}/restore', [LogsController::class, "restoreRow"]);
    });
});