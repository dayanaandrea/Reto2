@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles de la reunión</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $meeting->date }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Fecha :</p>
                <p class="col-sm-9">{{ $meeting->date }}</p>
                
                <p class="col-sm-3 fw-bold">Hora:</p>
                <p class="col-sm-9">{{ $meeting-> time }}</p>

                <p class="col-sm-3 fw-bold">Estados :</p>
                <p class="col-sm-9">{{ $meeting-> status }} </p>
                
                <p class="col-sm-3 fw-bold">Nombre del profesor al que pertenece :</p>
                <p class="col-sm-9">{{$meeting->teacher->name}} {{$meeting->teacher->lastname}}</p>
          
                <p class="col-sm-3 fw-bold">Nombre del estudiante al que pertenece :</p>
                <p class="col-sm-9">{{ $meeting->student->name }} {{$meeting->student->lastname}}</p>

                <div>
                        <!-- Los botones de las operaciones CRUD solo aparecen para los god y admin -->
                        @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                        @php
                        $route = route('admin.meetings.edit', $meeting);
                        $type = "edit";
                        $text = '<i class="fa-solid fa-pen"></i>';
                        $tooltip = __('meeting.edit_data_meeting');
                        @endphp
                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                        @php
                        $id_modal = '#modal_delete' . $meeting->id;
                        $text = '<i class="fa-solid fa-trash-can"></i>';
                        $tooltip =  __('meeting.delete_meeting');
                        @endphp

                        <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Modal para eliminar una reunión-->
@php
$id = 'modal_delete' . $meeting->id;
$mensaje = "¿Estás seguro de que deseas eliminar la reunión <strong>$meeting->name</strong>? Esta acción no se puede deshacer.";
$ruta = route('admin.meetings.destroy', $meeting);
@endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />   
@endsection