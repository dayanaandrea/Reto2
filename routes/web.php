<?php

use App\Http\Middleware\CheckAdminRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MeetingController;

use Illuminate\Support\Facades\Auth;

Route::permanentRedirect('/', '/home');

Auth::routes();

// Rutas protegidas por autenticación (middleware 'auth')
Route::middleware('auth')->group(function () {

  // Ruta para el home, solo accesible para usuarios autenticados
  Route::get('home', [HomeController::class, 'index'])->name('home');

  // Ruta para cambiar la contraseña de un usuario
  Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

  // Ruta para cambiar la contraseña de un usuario
  Route::get('users/{user}/change-pass', [UserController::class, 'changePass'])->name('users.change-pass');
  // Ruta para guardar la nueva contraseña de un usuario
  Route::put('users/{user}/store-pass', [UserController::class, 'storePass'])->name('users.store-pass');

  // Rutas del administrador
  Route::prefix('admin')->name('admin.')->middleware(CheckAdminRole::class)->group(function () {
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

    // Rutas de matriculas
    Route::resource('enrollments', EnrollmentController::class);
   
    // Rutas de asignaciones
    Route::resource('assignments', AssignmentController::class);

    // Rutas de horarios
    Route::resource('schedules', ScheduleController::class);

     // Rutas de reuniones
     Route::resource('meetings', MeetingController::class);


  });

});

