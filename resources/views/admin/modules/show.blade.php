@extends('layouts.app-admin')
@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del modulo</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $module->name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Codigo :</p>
                <p class="col-sm-9">{{ $module->code }}</p>

                <p class="col-sm-3 fw-bold">Horas:</p>
                <p class="col-sm-9">{{ $module->hours }}</p>

                <p class="col-sm-3 fw-bold">Curso :</p>
                <p class="col-sm-9">{{ $module->course }} </p>

                <p class="col-sm-3 fw-bold">Ciclo:</p>
                <p class="col-sm-9">{{ $module->cycle->code }} {{ $module->cycle->name }}</p>

                <p class="col-sm-3 fw-bold">Profesor:</p>
                @if ($module->user)
                    <p class="col-sm-9"><a href="{{route('admin.users.show', $module->user)}}">{{$module->user->name}}
                            {{$module->user->lastname}}</a></p>
                @else
                    <p class="col-sm-9">No asignado</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection