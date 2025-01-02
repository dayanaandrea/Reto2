@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del ciclo</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $cycle->name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Codigo :</p>
                <p class="col-sm-9">{{ $cycle->code }}</p>
                
                <p class="col-sm-3 fw-bold">Nombre:</p>
                <p class="col-sm-9">{{ $cycle->name }}</p>
            </div>
        </div>
    </div>
</div>
@endsection