@extends('layouts.app-admin')

@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <h2>Crear un nuevo rol</h2>
    <p><a href="{{ route('admin.roles.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
            data-bs-placement="top" title="Crear un nuevo rol"><i class="fa-solid fa-plus"></i></a></p>
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
                                            $text = '<i class="fa-solid fa-eye"></i>';
                                            $tooltip = 'Ver datos del rol';
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                                        @php
                                            $route = route('admin.roles.edit', $role);
                                            $type = "edit";
                                            $text = '<i class="fa-solid fa-pen"></i>';
                                            $tooltip = 'Editar datos del rol';
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                                        @php
                                            $id_modal = '#modal_delete' . $role->id;
                                            $text = '<i class="fa-solid fa-trash-can"></i>';
                                            $tooltip = 'Eliminar rol';
                                        @endphp
                                        <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                                    </td>
                                </tr>

                                <!-- Modal para eliminar un rol -->
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