@extends('layouts.app')

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
                    <img src="{{obtenerFoto($user)}}" alt="profile_img" class="img-fluid rounded-circle"
                        data-bs-toggle="modal" data-bs-target="#changeImageModal" id="profile_img">
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
                            }
                        @endphp
                        <x-detail :label="__('user.role')" :value="$badge" :route="$route" />

                        <x-detail :label="__('user.pin')" :value="$user->pin" />
                        <x-detail :label="__('user.address')" :value="$user->address" />
                        <x-detail :label="__('user.phone1')" :value="$user->phone1" />
                        @if ($user->phone2 != null)
                            <x-detail :label="__('user.phone2')" :value="$user->phone2" />
                        @endif

                        <div>
                            @php
                                $route = route('change-pass');
                                $type = "show";
                                $text = '<i class="fa-solid fa-lock"></i>';
                                $tooltip = 'Cambiar contraseña';
                            @endphp
                            <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modals.image :id="'changeImageModal'" />
@endsection