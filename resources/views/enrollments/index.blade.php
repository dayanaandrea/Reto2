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
                <th scope="col">Estudiante</th>
                <th scope="col">Modulo</th>
                <th scope="col">Ciclo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Curso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
                        @php
                            // Definir la clase dependiendo del rol del usuario
                            $clase = '';

                            if ($enrollment->role->role == 'god') {
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
                            <td>{{$enrollment->user.name}}</td>
                            <td>{{$enrollment->user.id}}</td>
                            <td>{{$enrollment->module.name}}</td>
                            <td>{{$enrollment->module.id}}</td>
                            <td><a href="{{ route('admin.enrolment.show', $enrollment) }}" class="btn btn-secondary btn-sm">
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
        {!! $users->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection