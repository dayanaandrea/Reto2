<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\RoleController;

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
      // Ruta para resetear la contraseña de un usuario
      Route::put('users/{user}/reset', [UserController::class, 'reset'])->name('users.reset');
      // Ruta para cambiar la contraseña de un usuario
      Route::put('users/{user}/changePass', [UserController::class, 'changePass'])->name('users.changePass');
      
      // Rutas de roles
      Route::resource('roles', RoleController::class);

      // Rutas de modulos 
      Route::resource('modules', ModuleController::class);
      
      // Rutas de ciclos
      Route::resource('cycles', CycleController::class);
  });

});