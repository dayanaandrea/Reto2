@extends('layouts.app-admin')

@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />

    <h2 class="mb-4">{{ __('user.title_show') }}</h2>
    <!-- Tarjeta para mostrar detalles del usuario -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $user->name }} {{ $user->lastname }}</h4>
        </div>
        <div class="card-body px-0">
            <!-- Contenedor principal con flexbox -->
            <div class="d-flex align-items-center">
                <!-- Contenedor de imagen -->
                <div class="col-2 d-flex justify-content-center mx-5">
                    <!-- Contenedor de imagen con fondo -->
                    <div class="rounded-image-container" style="background-image: url('{{ obtenerFoto($user) }}');">
                    </div>
                </div>
                <!-- Contenedor de texto -->
                <div class="col-6">
                    <div class="row">
                        <x-detail :label=" __('user.email')" :value="$user->email" />
                        <x-detail :label="__('user.name')" :value="$user->name . ' ' . $user->lastname" />
                        @php
                        if ($user->role) {
                        // Definir la clase dependiendo del rol del usuario
                        $clase = obtenerEstiloRol($user->role->role);
                        $badge = '<span class="badge ' . $clase . ' text-capitalize">' . $user->role->role . '</span>';
                        $route = route('admin.roles.show', $user->role);
                        } else {
                        $clase = obtenerEstiloRol(null);
                        $badge = '<span class="badge text-dark ' . $clase . ' text-capitalize">Sin Rol</span>';
                        $route = '#';
                        }
                        @endphp
                        <x-detail :label="__('user.role')" :value="$badge" :route="$route" />

                        <!-- La información personal solo aparece para los god o admin, o el propio usuario logueado (su perfil) -->
                        @if((Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god')) || Auth::user()->id === $user->id)
                        <x-detail :label="__('user.pin')" :value="$user->pin" />
                        <x-detail :label="__('user.address')" :value="$user->address" />
                        <x-detail :label="__('user.phone1')" :value="$user->phone1" />
                        @if ($user->phone2 != null)
                        <x-detail :label="__('user.phone2')" :value="$user->phone2" />
                        @endif
                        @php
                        if($user->intensive==0){
                            $value = 'No';
                        } else {
                            $value = 'Sí';
                        }
                        @endphp
                        <x-detail :label="'Dual intensiva'" :value="$value" />

                        <!--
                                                                        <x-detail :label="__('user.creation_date')" :value="$user->created_at->format('d/m/Y')" />
                                                                        <x-detail :label="__('user.update_date')" :value="$user->updated_at->format('d/m/Y')" />
                                                                    -->
                        @endif

                        @if(Auth::user()->role && (Auth::user()->role->role == 'god' || Auth::user()->role->role == 'administrador'))
                        @if($user->role && ($user->role->role == 'profesor' || $user->role->role == 'estudiante'))
                        <p class="col-sm-3 fw-bold">{{__('user.schedule')}}</p>
                        <div class="col-sm-9">
                            @php
                            if ($user->role->role == 'profesor') {
                            $schedules = $user->teacherSchedules;
                            } else {
                            $schedules = $user->studentSchedules;
                            }
                            @endphp

                            @if($schedules->isEmpty())
                            <p>{{__('user.no_schedule')}}</p>
                            @else
                            <x-tables.schedule :schedules="$schedules" />
                            @endif
                        </div>
                        @endif
                        @endif

                        <div>
                            <!-- Los botones de las operaciones CRUD solo aparecen para los god y admin -->
                            @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                            @php
                            $route = route('admin.users.edit', $user);
                            $type = "edit";
                            $text = '<i class="fa-solid fa-pen"></i>';
                            $tooltip = __('user.tp_edit');
                            @endphp
                            <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                            <x-buttons.reset :user="$user" />
                            @php
                            $id_modal = '#modal_delete' . $user->id;
                            $text = '<i class="fa-solid fa-trash-can"></i>';
                            $tooltip = __('user.tp_delete');
                            @endphp
                            <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                            @endif
                            <!-- El botón de cambiar contraseña solo aparece si es el usuario logueado -->
                            @if(Auth::user()->id === $user->id)
                            @php
                            $route = route('admin.users.change-pass', $user);
                            $type = "show";
                            $text = '<i class="fa-solid fa-lock"></i>';
                            $tooltip = 'Cambiar contraseña';
                            @endphp
                            <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para eliminar un usuario -->
@php
$id = 'modal_delete' . $user->id;
$mensaje = "¿Estás seguro de que deseas eliminar el usuario <strong>$user->email</strong>? Esta acción no se puede deshacer.";
$ruta = route('admin.users.destroy', $user);
@endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
@endsection