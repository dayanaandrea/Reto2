@extends('layouts.app-admin')

@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <h2 class="mb-4">{{__('role.details')}}</h2>

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
                <x-detail :label="__('role.role')" :value="$badge" />
                <x-detail :label="__('role.description')" :value="$description" />
                <x-detail :label="__('role.user')" :value="$userCount" />
                <div>
                    @php
                    $route = route('admin.roles.edit', $role);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('role.edit_data_role');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $role->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('role.delete_role');
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
$mensaje =__('role.confirm_1') . "<strong class='text-capitalize'>$role->role</strong>" . __('role.confirm_2');
$ruta = route('admin.roles.destroy', $role);
@endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
@endsection