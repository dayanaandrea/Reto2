@extends('layouts.app-admin')

@section('content')
<div class="container">
    
    <h2 class="mb-4">Detalles del ciclo</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $cycle->name }}</h4>
        </div>
        <div class="card-body">
            <div class="col-6">

                <div class="row">
                    <x-detail :label="'Código:'" :value="$cycle->code" />
                    <x-detail :label="'Nombre:'" :value="$cycle->name" />
                    <p class="col-sm-3 fw-bold d-inline">Módulos</p>
                    <div class="col-sm-9 d-inline">
                        <ul class="list-group">
                            @foreach($cycle->modules as $module)
                            <li class="list-group-item">{{$module->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <!-- Los botones de las operaciones CRUD solo aparecen para los god y admin -->
                        @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                        @php
                        $route = route('admin.cycles.edit', $cycle);
                        $type = "edit";
                        $text = '<i class="fa-solid fa-pen"></i>';
                        $tooltip = 'Editar datos del ciclo';
                        @endphp
                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                        @php
                        $id_modal = '#modal_delete' . $cycle->id;
                        $text = '<i class="fa-solid fa-trash-can"></i>';
                        $tooltip = 'Eliminar ciclo';
                        @endphp

                        <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Modal para eliminar un usuario -->
@php
$id = 'modal_delete' . $cycle->id;
$mensaje = "¿Estás seguro de que deseas eliminar el ciclo <strong>$cycle->name</strong>? Esta acción no se puede deshacer.";
$ruta = route('admin.cycles.destroy', $cycle);
@endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
@endsection