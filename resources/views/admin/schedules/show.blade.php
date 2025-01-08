@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del modulo</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $schedule->name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Dia :</p>
                <p class="col-sm-9">{{ $schedule->day }}</p>
                
                <p class="col-sm-3 fw-bold">Hora:</p>
                <p class="col-sm-9">{{ $schedule-> hour }}</p>
 
                <p class="col-sm-3 fw-bold">Nombre del profesor al que pertenece :</p>
                <p class="col-sm-9">{{ $schedule->user->name }} {{ $schedule->user->name }}</p>

                <p class="col-sm-3 fw-bold">Nombre del modulo al que pertenece :</p>
                <p class="col-sm-9">{{ $schedule->module->code }} {{ $schedule->module->name }}</p>

            </div>
        </div>
    </div>
</div>
@endsection