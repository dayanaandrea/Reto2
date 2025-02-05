@extends('layouts.app-admin')

@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />
    <h2 class="mb-4">{{__('schedule.show_title')}}</h2>

    <!-- Tarjeta para mostrar detalles de los horarios -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$schedule->module->name}}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">{{__('schedule.day')}}</p>
                <p class="col-sm-9">{{ $schedule->day }}</p>

                <p class="col-sm-3 fw-bold">{{__('schedule.hour')}}</p>
                <p class="col-sm-9">{{ $schedule-> hour }}</p>

                <p class="col-sm-3 fw-bold">{{__('schedule.module')}}</p>
                <p class="col-sm-9">{{$schedule->module->code}} {{$schedule->module->name}}</p>

                <p class="col-sm-3 fw-bold">{{__('schedule.teacher')}}</p>
                @if ($schedule->module->user)
                <p class="col-sm-9"><a href="{{route('admin.schedules.show', $schedule->module->user)}}">{{$schedule->module->user->name}} {{$schedule->module->user->lastname}}</a></p>
                @else
                <p class="col-sm-9">{{__('schedule.not_assigned')}}</p>
                @endif
                <div>
                    <!-- Los botones de las operaciones CRUD solo aparecen para los god y admin -->
                    @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                    @php
                    $route = route('admin.schedules.edit', $schedule);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('schedule.edit_data_module');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    @php
                    $id_modal = '#modal_delete' . $schedule->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('schedule.delete_schedule');
                    @endphp

                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal para eliminar un horario -->
@php
$id = 'modal_delete' . $schedule->id;
$mensaje = "¿Estás seguro de que deseas eliminar el horario <strong>$schedule->name</strong>? Esta acción no se puede deshacer.";
$ruta = route('admin.schedules.destroy', $schedule);
@endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
@endsection