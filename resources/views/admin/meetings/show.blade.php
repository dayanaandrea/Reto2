@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del modulo</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $meeting->date }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Fecha :</p>
                <p class="col-sm-9">{{ $meetings->date }}</p>
                
                <p class="col-sm-3 fw-bold">Hora:</p>
                <p class="col-sm-9">{{ $meetings-> time }}</p>

                <p class="col-sm-3 fw-bold">Estados :</p>
                <p class="col-sm-9">{{ $meetings-> status }} </p>
                
                <p class="col-sm-3 fw-bold">Nombre del profesor al que pertenece :</p>
                <p class="col-sm-9">{{$meetings->teacher->name}}</p>
          
                <p class="col-sm-3 fw-bold">Nombre del estudiante al que pertenece :</p>
                <p class="col-sm-9">{{ $meetings->student->name }} </p>
            </div>
        </div>
    </div>
</div>
@endsection