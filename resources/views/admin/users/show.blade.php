@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
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
                        <x-detail :label="'DNI:'" :value="$user->pin" />
                        <x-detail :label="'Dirección:'" :value="$user->address" />
                        <x-detail :label="'Teléfono:'" :value="$user->phone1" />
                        @if ($user->phone2 != null)
                            <x-detail :label="'Teléfono secundario:'" :value="$user->phone2" />
                        @endif

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
                        <x-detail :label="'Fecha de Creación:'" :value="$user->created_at->format('d/m/Y')" />
                        <x-detail :label="'Última actualización:'" :value="$user->updated_at->format('d/m/Y')" />

                        <div>
                            @php
                                $route = route('admin.users.edit', $user);
                                $type = "edit";
                                $text = "Editar";
                            @endphp
                            <x-buttons.generic :route="$route" :type="$type" :text="$text" />
                            @php
                                $id_modal = '#modal_delete' . $user->id;
                            @endphp
                            <x-buttons.delete :id="$id_modal" />
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