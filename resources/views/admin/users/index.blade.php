@extends('layouts.app')

@php
$user = Auth::user();
@endphp

@section('content')
<div class="container">
    <h2>Crear un nuevo usuario</h2>
    <div>
        <p>Accede a la creación de usuarios:</p>
        <p><a href="{{ route('admin.users.create') }}" class="btn btn-primary">Crear usuario</a></p>
    </div>
    @if ($users->count() > 0)
    <h2>Usuarios</h2>
    <div>
        <table class="table table-hover table-striped">
            <thead>
                <tr class="text-uppercase table-dark">
                    <th scope="col"></th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
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
                <tr>
                    <td><img src="{{obtenerFoto($user)}}" alt="profile_img" width="20px"></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->lastname}}</td>
                    <td class="text-capitalize"><span class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span></td>
                    <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                    <td><a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary btn-sm">
                            Ver
                        </a>
                        <a href="#" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalUsuario{{ $user->id }}"
                            data-user-id="{{ $user->id }}">
                            Eliminar
                        </a>
                    </td>
                </tr>

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
                                ¿Estás seguro de que deseas eliminar al usuario <b>{{$user->email}}</b>? Esta acción no se puede deshacer.
                            </div>

                            <!-- Pie del Modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <!-- Formulario de eliminación -->
                                <form action="{{route('admin.users.destroy', $user)}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
        <div>
            {!! $users->appends(['active' => request()->active, 'inactive' => request()->inactive])->links('vendor.pagination.bootstrap-5') !!}
        </div>
    </div>
    @endif

    @if ($del_users->count() > 0)
    <h2>Usuarios Eliminados</h2>
    <div>
        <table class="table table-hover table-striped">
            <thead>
                <tr class="text-uppercase table-dark">
                    <th scope="col"></th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Fecha de eliminación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($del_users as $user)
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
                <tr>
                    <td><img src="{{obtenerFoto($user)}}" alt="profile_img" width="20px"></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->lastname}}</td>
                    <td class="text-capitalize"><span class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span></td>
                    <td>{{ date('d-m-Y', strtotime($user->deleted_at)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
        <div>
            {!! $del_users->appends(['active' => request()->active, 'inactive' => request()->inactive])->links('vendor.pagination.bootstrap-5') !!}
        </div>
    </div>
    @endif
</div>
@endsection