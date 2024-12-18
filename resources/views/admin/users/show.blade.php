@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del Usuario</h2>

    <!-- Tarjeta para mostrar detalles del usuario -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $user->name }} {{ $user->lastname }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">Correo electrónico:</p>
                <p class="col-sm-9">{{ $user->email }}</p>

                <p class="col-sm-3 fw-bold">Nombre completo:</p>
                <p class="col-sm-9">{{ $user->name }} {{ $user->lastname }}</p>

                @php
                // Definir la clase dependiendo del rol del usuario
                $clase = '';

                if ($user->role->role == 'god') {
                $clase = 'bg-danger';
                } elseif ($user->role->role == 'administrador') {
                $clase = 'bg-warning';
                } elseif ($user->role->role == 'profesor') {
                $clase = 'bg-primary';
                } else {
                $clase = 'bg-success';
                }
                @endphp

                <p class="col-sm-3 fw-bold">DNI:</p>
                <p class="col-sm-9">{{ $user->pin }}</p>

                <p class="col-sm-3 fw-bold">Dirección:</p>
                <p class="col-sm-9">{{ $user->address }}</p>

                <p class="col-sm-3 fw-bold">Teléfono:</p>
                <p class="col-sm-9">{{ $user->phone1 }}</p>

                @if ($user->phone2 != null)
                <p class="col-sm-3 fw-bold">Teléfono 2:</p>
                <p class="col-sm-9">{{ $user->phone2 }}</p>
                @endif

                <p class="col-sm-3 fw-bold">Rol:</p>
                <p class="col-sm-9"><span class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span></p>

                <p class="col-sm-3 fw-bold">Fecha de creación:</p>
                <p class="col-sm-9">{{ $user->created_at->format('d/m/Y') }}</p>

                <p class="col-sm-3 fw-bold">Última actualización:</p>
                <p class="col-sm-9">{{ $user->updated_at->format('d/m/Y') }}</p>

                <p class="col-sm-3 fw-bold">Foto de perfil:</p>

                <div class="mw-100 my-4">
                    <img src="{{obtenerFoto($user)}}" alt="profile_img" width="200px">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection