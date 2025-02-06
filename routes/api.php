<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController as V1AuthController;
use App\Http\Controllers\API\V1\RoleController as V1RoleController;
use App\Http\Controllers\API\V1\UserController as V1UserController;
use App\Http\Controllers\API\V2\VersionController;

// Rutas para la versión 1.0
Route::prefix('v1.0')->group(function () {
    Route::post('/login', [V1AuthController::class, 'login']);
    Route::post('/logout', [V1AuthController::class, 'logout'])->middleware('auth:sanctum');


    Route::middleware(['auth:sanctum', 'App\Http\Middleware\CheckAdminRoleAPI'])->group(function () {
        Route::apiResource('roles', V1RoleController::class);
        Route::apiResource('users', V1UserController::class);
    });
});

// Rutas para la versión 2.0
Route::prefix('v2.0')->middleware(\App\Http\Middleware\AddVersionToResponse::class)->group(function () {
    Route::get('/', [VersionController::class, 'showVersion']);
    Route::post('/login', [V1AuthController::class, 'login']);
    Route::post('/logout', [V1AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum', 'App\Http\Middleware\CheckAdminRoleAPI'])->group(function () {
        Route::apiResource('roles', V1RoleController::class);
        Route::apiResource('users', V1UserController::class);
    });
});
