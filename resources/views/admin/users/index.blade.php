@extends('layouts.app')

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
                                    if ($user->role) {
                                        // Definir la clase dependiendo del rol del usuario
                                        $clase = obtenerEstiloRol($user->role->role);
                                    } else {
                                        $clase = obtenerEstiloRol(null);
                                    }
                                @endphp
                                <tr>
                                    <td><img src="{{obtenerFoto($user)}}" alt="profile_img" class="img-fluid rounded-circle"
                                            style="max-width: 30px; max-height: 30px;"></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->lastname}}</td>
                                    @if ($user->role)
                                        <td class="text-capitalize">
                                            <span class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span>
                                        </td>
                                    @else
                                        <td class="text-capitalize">
                                            <span class="badge {{$clase}} text-capitalize text-dark">Sin rol</span>
                                        </td>
                                    @endif

                                    <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                    <td>
                                        @php
                                            $route = route('admin.users.show', $user);
                                            $type = "show";
                                            $text = "Ver";
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" />
                                        @php
                                            $route = route('admin.users.edit', $user);
                                            $type = "edit";
                                            $text = "Editar";
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" />
                                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                                        @php
                                            $id_modal = '#modal_delete' . $user->id;
                                        @endphp
                                        <x-buttons.delete :id="$id_modal" />
                                    </td>
                                </tr>

                                <!-- Modal para eliminar un usuario -->
                                @php
                                    $id = 'modal_delete' . $user->id;
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