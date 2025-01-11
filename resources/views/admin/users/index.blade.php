@extends('layouts.app-admin')

@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />

    <div class="mb-2">
        @php
            $route = route('admin.users.create');
            $type = "show";
            $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">Añadir</span>';
            $tooltip = __('user.tp_create');
        @endphp
        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
    </div>

    @if ($users->count() > 0)
        <h2>{{ __('user.title_index_2') }}</h2>
        <div>
            <table class="table table-hover table-striped lista">
                <thead>
                    <tr class="text-uppercase table-dark">
                        <th scope="col"></th>
                        <th scope="col">{{ __('user.name') }}</th>
                        <th scope="col">{{ __('user.email') }}</th>
                        <th scope="col">{{ __('user.role') }}</th>
                        <th scope="col">{{ __('user.creation_date') }}</th>
                        <th scope="col">{{ __('user.actions') }}</th>
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
                                    <td>{{$user->name}} {{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    @if ($user->role)
                                                @php
                                                    $route = route('admin.roles.show', $user->role);
                                                @endphp
                                                <td class="text-capitalize">
                                                    <a href="{{$route}}"><span
                                                            class="badge {{$clase}} text-capitalize">{{ $user->role->role }}</span></a>
                                                </td>
                                    @else
                                        <td class="text-capitalize">
                                            <span class="badge {{$clase}} text-capitalize text-dark">{{ __('user.no_role') }}</span>
                                        </td>
                                    @endif

                                    <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                    <td>
                                        @php
                                            $route = route('admin.users.show', $user);
                                            $type = "show";
                                            $text = '<i class="fa-solid fa-eye"></i>';
                                            $tooltip = __('user.tp_show');
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                                        @php
                                            $route = route('admin.users.edit', $user);
                                            $type = "edit";
                                            $text = '<i class="fa-solid fa-pen"></i>';
                                            $tooltip = __('user.tp_edit');
                                        @endphp
                                        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                                        <x-buttons.reset :user="$user" />
                                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                                        @php
                                            $id_modal = '#modal_delete' . $user->id;
                                            $text = '<i class="fa-solid fa-trash-can"></i>';
                                            $tooltip = __('user.tp_edit');
                                        @endphp
                                        <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                                    </td>
                                </tr>

                                <!-- Modal para eliminar un usuario -->
                                @php
                                    $id = 'modal_delete' . $user->id;
                                    $mensaje = __('modals.delete_msg', ['email' => $user->email, 'item' => 'el usuario']);
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
        <h2>{{ __('user.title_index_3') }}</h2>
        <div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="text-uppercase table-dark">
                        <th scope="col"></th>
                        <th scope="col">{{ __('user.email') }}</th>
                        <th scope="col">{{ __('user.name') }}</th>
                        <th scope="col">{{ __('user.lastname') }}</th>
                        <th scope="col">{{ __('user.role') }}</th>
                        <th scope="col">{{ __('user.deletion_date') }}</th>
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