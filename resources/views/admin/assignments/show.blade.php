@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles de la asignación</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Número de asignación: {{ $assignment->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row">

                <p class="col-sm-3 fw-bold">Estudiante :</p>
                <p class="col-sm-9">{{$assignment->user->lastname . ', ' . $assignment->user->name}}</p>
                
                <p class="col-sm-3 fw-bold">Modulo:</p>
                <p class="col-sm-9">{{$assignment->module->name }}</p>

            </div>
        </div>
    </div>
</div>
@endsection