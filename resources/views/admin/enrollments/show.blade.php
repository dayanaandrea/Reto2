@extends('layouts.app-admin')

@section('content')
<div class="container">

    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{__('enrollment.title_show_2')}}{{ $enrollment->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">{{__('enrollment.student')}}</p>
                <p class="col-sm-9">{{$enrollment->user->name . ', ' . $enrollment->user->lastname}}</p>

                <p class="col-sm-3 fw-bold">{{__('enrollment.module')}}</p>
                <p class="col-sm-9">{{$enrollment->module->name }}</p>

                <p class="col-sm-3 fw-bold">{{__('enrollment.cycle')}}</p>
                <p class="col-sm-9">{{$enrollment->module->cycle->name}} ({{$enrollment->module->cycle->code}})</p>

                <p class="col-sm-3 fw-bold">{{__('enrollment.date')}}</p>
                <p class="col-sm-9">{{ date('d-m-Y', strtotime($enrollment->created_at)) }}</p>

                <p class="col-sm-3 fw-bold">{{__('enrollment.course')}}</p>
                <p class="col-sm-9">{{$enrollment->module->course }}</p>

                <!-- Botones de Editar y Eliminar -->
                <div class="mt-4">
                    @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                    @php
                    // Ruta de edición para la matrícula
                    $routeEdit = route('admin.enrollments.edit', $enrollment);
                    $typeEdit = "edit";
                    $textEdit = '<i class="fa-solid fa-pen"></i>';
                    $tooltipEdit =__('enrollment.edit_data_enrollments');

                    // Ruta para la eliminación
                    $routeDelete = route('admin.enrollments.destroy', $enrollment->id);
                    $id_modal = 'modal_delete' . $enrollment->id;
                    $textDelete = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltipDelete = __('enrollment.delete_data_enrollments');
                    $mensajeDelete = __('enrollment.ask_for_delete_confirmation_1') . ' <b>' . $enrollment->name . '</b>' . __('enrollment.ask_for_delete_confirmation_2');
                    @endphp

                    <!-- Botón de editar -->
                    <x-buttons.generic :route="$routeEdit" :type="$typeEdit" :text="$textEdit" :tooltip="$tooltipEdit" />

                    <!-- Modal para eliminar la matrícula -->
                    @php
                    $id_modal = '#modal_delete' . $enrollment->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('enrollment.delete_enrollment');
                    @endphp

                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />

                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal para eliminar un horario -->
@php
$id = 'modal_delete' . $enrollment->id;
$mensaje = __('enrollment.ask_for_delete_confirmation_1') . ' <b>' . $enrollment->name . '</b>' . __('enrollment.ask_for_delete_confirmation_2');
$ruta = route('admin.enrollments.destroy', $enrollment);
@endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
@endsection