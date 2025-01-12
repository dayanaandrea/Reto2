@extends('layouts.app-admin')

@php
$user = Auth::user();
@endphp

@section('content')
<div class="container">
    <h2>Home de admin</h2>
    <p>Bienvenido {{$user->name}} {{$user->lastname}}</p>
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Número de alumnos -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Número de alumnos</div>
                <h5 class="card-title">{{ $totalAlumnos }}</h5>
                <div class="card-body">

            </div>
            </div>
        </div>

        <!-- Número de personal -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Número de personal</div>
                <div class="card-body">
                 
                </div>
            </div>
        </div>

        <!-- Reuniones aceptadas -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Reuniones aceptadas</div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Reuniones pendientes -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Reuniones pendientes</div>
                <div class="card-body">
                   
                </div>
            </div>
        </div>

        <!-- Reuniones totales -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Reuniones totales</div>
                <div class="card-body">
                   
                </div>
            </div>
        </div>

        <!-- Número de ciclos formativos -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Número de ciclos formativos</div>
                <h5 class="card-title">{{ $totalCiclos }}</h5>
                <div class="card-body">
                   
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Usuarios sin rol -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Usuarios sin rol</div>
                <h5 class="card-title">{{ $usuariosSinRol }}</h5>
                <div class="card-body">

                </div>
            </div>
        </div>

        <!-- Número de módulos -->
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-4">
                <div class="card-header">Número de módulos</div>
                <h5 class="card-title">{{ $totalModulos }}</h5>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection