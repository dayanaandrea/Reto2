@extends('layouts.app-admin')

@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <h2 class="mb-4">Detalles del rol</h2>

    <!-- Tarjeta para mostrar detalles de los roles -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-capitalize">{{ $role->role }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @php
                    // Definir la clase dependiendo del rol del usuario
                    $clase = obtenerEstiloRol($role->role);
                    $badge = '<span class="badge ' . $clase . ' text-capitalize">' . $role->role . '</span>';
                    $description = $role->description;
                @endphp
                <x-detail :label="'Rol:'" :value="$badge" />
                <x-detail :label="'Descripción:'" :value="$description" />
                <x-detail :label="'Usuarios:'" :value="$userCount" />
                <div>
                    @php
                        $route = route('admin.roles.edit', $role);
                        $type = "edit";
                        $text = '<i class="fa-solid fa-pen"></i>';
                        $tooltip = 'Editar datos del rol';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                        $id_modal = '#modal_delete' . $role->id;
                        $text = '<i class="fa-solid fa-trash-can"></i>';
                        $tooltip = 'Eliminar rol';
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para eliminar un rol -->
@php
    $id = 'modal_delete' . $role->id;
    $mensaje = "¿Estás seguro de que deseas eliminar el rol <strong class='text-capitalize'>$role->role</strong>? Esta acción no se puede deshacer.";
    $ruta = route('admin.roles.destroy', $role);
 @endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
@endsection