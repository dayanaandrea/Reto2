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
                        <p class="col-sm-9"><span
                                class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span></p>

                        <p class="col-sm-3 fw-bold">Fecha de creación:</p>
                        <p class="col-sm-9">{{ $user->created_at->format('d/m/Y') }}</p>

                        <p class="col-sm-3 fw-bold">Última actualización:</p>
                        <p class="col-sm-9">{{ $user->updated_at->format('d/m/Y') }}</p>
                        <div>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalUsuario{{ $user->id }}" data-user-id="{{ $user->id }}">
                                Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal para eliminar un usuario -->
<div class="modal fade" id="modalUsuario{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Encabezado del Modal -->
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar al usuario <b>{{$user->email}}</b>? Esta acción no
                se puede deshacer.
            </div>

            <!-- Pie del Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <!-- Formulario de eliminación -->
                <form action="{{route('admin.users.destroy', $user)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>