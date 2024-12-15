<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::permanentRedirect('/', '/home');

Auth::routes();

// Rutas protegidas por middleware 'auth' (solo accesibles si el usuario está autenticado)
Route::middleware(['auth'])->group(function () {

  // Ruta para el home, solo accesible para usuarios autenticados
  Route::get('home', [HomeController::class, 'index'])->name('home');

  // Ruta para el AdminController
  Route::get('admin', [AdminController::class, 'index'])->name('admin.index');

  // Rutas de administración
  Route::prefix('admin')->group(function () {
    // Ruta para ver todos los usuarios
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');

    // Ruta para ver los detalles de un solo usuario
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
  });

});