@extends('layouts.app')

@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />

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
                    <img src="{{obtenerFoto($user)}}" alt="profile_img" class="img-fluid rounded-circle">
                </div>
                <!-- Contenedor de texto -->
                <div class="col-6">
                    <div class="row">
                        <x-detail :label="'Correo electrónico:'" :value="$user->email" />
                        <x-detail :label="'Nombre completo:'" :value="$user->name . ' ' . $user->lastname" />
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
                        <x-detail :label="'Rol:'" :value="$badge" :route="$route" />

                        <!-- La información personal solo aparece para los god o admin, o el propio usuario logueado (su perfil) -->
                        @if((Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god')) || Auth::user()->id === $user->id)
                        <x-detail :label="'DNI:'" :value="$user->pin" />
                        <x-detail :label="'Dirección:'" :value="$user->address" />
                        <x-detail :label="'Teléfono:'" :value="$user->phone1" />
                        @if ($user->phone2 != null)
                        <x-detail :label="'Teléfono secundario:'" :value="$user->phone2" />
                        @endif

                        <x-detail :label="'Fecha de Creación:'" :value="$user->created_at->format('d/m/Y')" />
                        <x-detail :label="'Última actualización:'" :value="$user->updated_at->format('d/m/Y')" />
                        @endif
                        <div>
                            <!-- Los botones de las operaciones CRUD solo aparecen para los god y admin -->
                            @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                            @php
                            $route = route('admin.users.edit', $user);
                            $type = "edit";
                            $text = '<i class="fa-solid fa-pen"></i>';
                            $tooltip = 'Editar datos del usuario';
                            @endphp
                            <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                            <x-buttons.reset :user="$user" />
                            @php
                            $id_modal = '#modal_delete' . $user->id;
                            $text = '<i class="fa-solid fa-trash-can"></i>';
                            $tooltip = 'Eliminar usuario';
                            @endphp
                            <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                            @endif
                            <!-- El botón de cambiar contraseña solo aparece si es el usuario logueado -->
                            @if(Auth::user()->id === $user->id)
                            @php
                            $route = route('users.change-pass', $user);
                            $type = "show";
                            $text = '<i class="fa-solid fa-lock"></i>';
                            $tooltip = 'Cambiar contraseña';
                            @endphp
                            <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                            @endif
                        </div>
                        <div>
                            <p>Cambiar idioma</p>
                            <a href="{{ route('set-locale', 'en') }}">
                                EN
                            </a>
                            <a href="{{ route('set-locale', 'es') }}">
                                ES
                            </a>
                            <a href="{{ route('set-locale', 'eus') }}">
                                EUS
                            </a>
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