@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del horario</h2>

    <!-- Tarjeta para mostrar detalles de los horarios -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $schedule->day }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Dia:</p>
                <p class="col-sm-9">{{ $schedule->day }}</p>
                
                <p class="col-sm-3 fw-bold">Hora:</p>
                <p class="col-sm-9">{{ $schedule-> hour }}</p>

                <p class="col-sm-3 fw-bold">Módulo pertenece:</p>
                <p class="col-sm-9">{{$schedule->module->code}} {{$schedule->module->name}}</p>

               <p class="col-sm-3 fw-bold">Profesor :</p>
               @if ($schedule->module->user)
                    <td><a href="{{route('admin.schedules.show', $schedule->module->user)}}"
                    >{{$schedule->module->user->name}} {{$schedule->module->user->lastname}}</a></td>
               @else
                     <td>{{__('module.not_assigned')}}</td>
               @endif
            </div>
        </div>
    </div>
</div>
@endsection