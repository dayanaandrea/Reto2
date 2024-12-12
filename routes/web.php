<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;

Route::permanentRedirect('/', '/home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'home' => HomeController::class,
        'admin' => AdminController::class,
        'student' => StudentController::class
        
      ]);
});
