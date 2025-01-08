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
                <th scope="col">Nombre profesor</th>
                <th scope="col">Id profesor</th>
                <th scope="col">Nombre modulo</th>
                <th scope="col">Id modulo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
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

                        <!-- Modal para eliminar un assignment -->
                        <div class="modal fade" id="modalAssignment{{ $assignment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
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
                                        ¿Estás seguro de que deseas eliminar la asignación <b>{{$assignment->user.name}} - {{$assignment->user.name}} </b>? Esta acción no se puede deshacer.
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