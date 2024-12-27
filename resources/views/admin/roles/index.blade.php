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
    <h2>Crear un nuevo rol</h2>
    <div>
        <p>Accede a la creación de roles:</p>
        <p><a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Crear rol</a></p>
    </div>
    @if ($roles->count() > 0)
        <h2>Roles</h2>
        <div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="text-uppercase table-dark">
                        <th scope="col"></th>
                        <th scope="col">Rol</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Usuarios</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                                @php
                                    // Definir la clase dependiendo del rol del usuario
                                    $clase = obtenerEstiloRol($role->role);
                                @endphp
                                <tr>
                                    <td class="fw-bold">{{ $loop->iteration }}</td>
                                    <td class="text-capitalize"><span class="badge {{$clase}} text-capitalize">{{ $role->role }}</span>
                                    </td>
                                    <td>{{$role->description}}</td>
                                    <td>{{ $role->users_count }}</td>
                                    <td>
                                        @php
                                            $route = route('admin.roles.show', $role);
                                            $type = "show";
                                            $text = "Ver";
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" />
                                        @php
                                            $route = route('admin.roles.edit', $role);
                                            $type = "edit";
                                            $text = "Editar";
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" />
                                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                                        @php
                                            $id_modal = '#modal_delete' . $role->id;
                                        @endphp
                                        <x-buttons.delete :id="$id_modal" />
                                    </td>
                                </tr>

                                <!-- Modal para eliminar un usuario -->
                                @php
                                    $id = 'modal_delete' . $role->id;
                                    $mensaje = "¿Estás seguro de que deseas eliminar el rol <strong class='text-capitalize'>$role->role</strong>? Esta acción no se puede deshacer.";
                                    $ruta = route('admin.roles.destroy', $role);
                                 @endphp
                                <x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
                    @endforeach
                </tbody>
            </table>
            @if($sin_roles > 0)
                <p class="text-muted">Usuarios sin roles: <strong>{{$sin_roles}}</strong></p>
            @endif
            <!-- Paginación -->
            <div>
                {!! $roles->links('vendor.pagination.bootstrap-5') !!}
            </div>
        </div>
    @endif
@endsection