@extends('layouts.app-admin')

@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <div class="mb-2 text-end">
        @php
            $route = route('admin.roles.create');
            $type = "show";
            $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">Añadir</span>';
            $tooltip =  __('role.create_role');
        @endphp
        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
    </div>
    @if ($roles->count() > 0)
        <h2>{{__('role.roles')}}</h2>
        <div>
            <table class="table table-hover table-striped table-responsive">
                <thead>
                    <tr class="text-uppercase table-dark">
                        <th scope="col"></th>
                        <th scope="col">{{__('role.role')}}</th>
                        <th scope="col">{{__('role.description')}}</th>
                        <th scope="col">{{__('role.user')}}</th>
                        <th scope="col">{{__('role.actions')}}</th>
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
                                            $tooltip = __('role.see_data_role');
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                                        @php
                                            $route = route('admin.roles.edit', $role);
                                            $type = "edit";
                                            $text = '<i class="fa-solid fa-pen"></i>';
                                            $tooltip = __('role.edit_data_role');
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                                        @php
                                            $id_modal = '#modal_delete' . $role->id;
                                            $text = '<i class="fa-solid fa-trash-can"></i>';
                                            $tooltip = __('role.delete_role');
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
                <p class="text-muted">{{__('role.user_without_role')}} <strong>{{$sin_roles}}</strong></p>
            @endif
            <!-- Paginación -->
            <div>
                {!! $roles->links('vendor.pagination.bootstrap-5') !!}
            </div>
        </div>
    @endif
    @endsection