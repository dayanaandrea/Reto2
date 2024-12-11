<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home/profesores', 'indexProfesores')->name('profesores.index');
});