@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del ciclo</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Número de matricula: {{ $enrollment->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Estudiante :</p>
                <p class="col-sm-9">{{$enrollment->user->name . ', ' . $enrollment->user->lastname}}</p>
                
                <p class="col-sm-3 fw-bold">Modulo:</p>
                <p class="col-sm-9">{{$enrollment->module->name }}</p>

                <p class="col-sm-3 fw-bold">Ciclo:</p>
                <p class="col-sm-9">{{$enrollment->module->cycle->name}} ({{$enrollment->module->cycle->code}})</p>

                <p class="col-sm-3 fw-bold">Fecha:</p>
                <p class="col-sm-9">{{$enrollment->date}}</p>
            </div>
        </div>
    </div>
</div>
@endsection