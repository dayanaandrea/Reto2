@extends('layouts.app')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="container">
    <h2>Usuarios</h2>
    <table class="table table-hover">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">Correo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                        @php
                            // Definir la clase dependiendo del rol del usuario
                            $clase = '';

                            if ($user->role->role == 'god') {
                                $clase = 'table-danger';
                            } elseif ($user->role->role == 'administrador') {
                                $clase = 'table-warning';
                            } elseif ($user->role->role == 'profesor') {
                                $clase = 'table-primary';
                            } else {
                                $clase = 'table-success';
                            }
                        @endphp
                        <tr class="{{$clase}}">
                            <th scope="col">{{ $loop->iteration }}</th>
                            <td>{{$user->email}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->lastname}}</td>
                            <td class="text-capitalize">{{$user->role->role}}</td>
                            <td><a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary btn-sm">
                                    Ver
                                </a>
                                <a href="" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                                <a href="" class="btn btn-danger btn-sm">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $users->links('vendor.pagination.bootstrap-5') !!}
    </div>

</div>
@endsection