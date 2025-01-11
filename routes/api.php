<?php

use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\CheckAdminRoleAPI;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', CheckAdminRoleAPI::class])->group(function () {
    Route::apiresources([
        'roles' => RoleController::class,
    ]);
});