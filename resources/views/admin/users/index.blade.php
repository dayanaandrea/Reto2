@extends('layouts.app')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                                    $clase = obtenerEstiloRol($user->role->role);
                                @endphp
                                <tr>
                                    <td><img src="{{obtenerFoto($user)}}" alt="profile_img" class="img-fluid rounded-circle"
                                            style="max-width: 30px; max-height: 30px;"></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td class="text-capitalize"><span
                                            class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span></td>
                                    <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                    <td><a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary btn-sm">
                                            Ver
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>
                                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal_delete{{ $user->id }}" data-user-id="{{ $user->id }}">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal para eliminar un usuario -->
                                @php
                                    $id = $user->id;
                                    $mensaje = "¿Estás seguro de que deseas eliminar el usuario <strong>$user->email</strong>? Esta acción no se puede deshacer.";
                                    $ruta = route('admin.users.destroy', $user);
                                 @endphp
                                <x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
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
                                    $clase = obtenerEstiloRol($user->role->role);
                                @endphp
                                <tr>
                                    <td><img src="{{obtenerFoto($user)}}" alt="profile_img" class="img-fluid rounded-circle"
                                            style="max-width: 30px; max-height: 30px;"></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td class="text-capitalize"><span
                                            class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span></td>
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