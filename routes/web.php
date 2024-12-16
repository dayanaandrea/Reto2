<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::permanentRedirect('/', '/home');

Auth::routes();

// Rutas protegidas por autenticación (middleware 'auth')
Route::middleware('auth')->group(function () {

  // Ruta para el home, solo accesible para usuarios autenticados
  Route::get('home', [HomeController::class, 'index'])->name('home');

  // Rutas del administrador
  Route::prefix('admin')->name('admin.')->group(function () {
      // Ruta principal del panel de administración
      Route::get('/', [AdminController::class, 'index'])->name('index');

      // Rutas de users
      Route::resource('users', UserController::class);
  });

});