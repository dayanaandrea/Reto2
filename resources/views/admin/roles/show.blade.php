@extends('layouts.app')

@section('content')
<div class="container">
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
                @endphp
                <x-detail :label="'Rol:'" :value="$badge" />
                <x-detail :label="'Descripción:'" :value="$role->description" />
                <x-detail :label="'Usuarios:'" :value="$userCount" />
            </div>
        </div>
    </div>
</div>
@endsection