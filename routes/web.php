<?php

use App\Http\Middleware\CheckAdminRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::permanentRedirect('/', '/home');
Route::permanentRedirect('/admin', '/admin/home');

// Cambio de idioma
Route::get('lang/{locale}', [LocaleController::class, 'setLocale'])->name('lang');

Auth::routes();

// Rutas protegidas por autenticación (middleware 'auth')
Route::middleware('auth')->group(function () {

  // Ruta para el home, solo accesible para usuarios autenticados
  Route::get('home', [HomeController::class, 'home'])->name('home');
  Route::get('teachers', [HomeController::class, 'teachers'])->name('teachers');
  Route::get('cycles', [HomeController::class, 'cycles'])->name('cycles');
  Route::get('students', [HomeController::class, 'students'])->name('students');

  // Ruta para cambiar la contraseña de un usuario
  Route::get('profile', [ProfileController::class, 'show'])->name('profile');

  // Ruta para cambiar la contraseña de un usuario
  Route::get('change-pass', [ProfileController::class, 'changePass'])->name('change-pass');
  // Ruta para guardar la nueva contraseña de un usuario
  Route::put('store-pass', [ProfileController::class, 'storePass'])->name('store-pass');
  Route::put('store-image', [ProfileController::class, 'storeImage'])->name('store-image');

  // Rutas del administrador
  Route::prefix('admin')->name('admin.')->middleware(CheckAdminRole::class)->group(function () {
    // Ruta principal del panel de administración
    Route::get('/home', [HomeController::class, 'homeAdmin'])->name('home');

    // Rutas de users
    Route::resource('users', UserController::class);
    // Ruta para resetear la contraseña de un usuario
    Route::put('users/{user}/reset', [UserController::class, 'reset'])->name('users.reset');
    // Ruta para cambiar la contraseña de un usuario
    Route::put('users/{user}/store-pass', [UserController::class, 'storePass'])->name('users.store-pass');
    Route::get('users/{user}/change-pass', [UserController::class, 'changePass'])->name('users.change-pass');

    // Rutas de roles
    Route::resource('roles', RoleController::class);

    // Rutas de modulos 
    Route::resource('modules', ModuleController::class);

    // Rutas de ciclos
    Route::resource('cycles', CycleController::class);

    // Rutas de matriculas
    Route::resource('enrollments', EnrollmentController::class);

    // Rutas de horarios
    Route::resource('schedules', ScheduleController::class);

    // Rutas de reuniones
    Route::resource('meetings', MeetingController::class);
  });
});
