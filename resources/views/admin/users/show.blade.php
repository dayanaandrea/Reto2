@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('permission'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('permission') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="mb-4">Detalles del Usuario</h2>
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
                            } else {
                                $clase = obtenerEstiloRol(null);
                                $badge = '<span class="badge text-dark ' . $clase . ' text-capitalize">Sin Rol</span>';
                            }
                        @endphp
                        <x-detail :label="'Rol:'" :value="$badge" />

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
                                                            $text = "Editar";
                                                        @endphp
                                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" />
                                                        <x-buttons.reset :user="$user" />
                                                        @php
                                                            $id_modal = '#modal_delete' . $user->id;
                                                        @endphp
                                                        <x-buttons.open-modal :id="$id_modal" :text="'Eliminar'" :type="'danger'" />
                            @endif
                            <!-- El botón de cambiar contraseña solo aparece si es el usuario logueado -->
                            @if(Auth::user()->id === $user->id)
                                                        @php
                                                            $id_modal = '#modal_change' . $user->id;
                                                            $btn_open = 'btn_open' . $user->id;
                                                        @endphp
                                                        <x-buttons.open-modal :id="$id_modal" :text="'Cambiar Contraseña'" :type="'secondary'"
                                                            :btnOpen="$btn_open" />
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

<!-- Modal para actualizar la contraseña de un usuario -->
@php
    $id = 'modal_change' . $user->id;
    if (Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god')) {
        $ruta = route('admin.users.changePass', $user);
    } else {
        $ruta = route('users.changePass', $user);
    }
    $btn_open = 'btn_open' . $user->id;
@endphp
<x-modals.change-pass :id="$id" :mensaje="$mensaje" :ruta="$ruta" :btnOpen="$btn_open" />
@endsection