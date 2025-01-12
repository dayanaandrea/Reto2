@extends('layouts.app-admin')

@section('content')
<div class="container">

    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" schedule="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('permission'))
        <div class="alert alert-warning alert-dismissible fade show" schedule="alert">
            {{ session('permission') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2>Crear un nuevo horario</h2>
    <div>
        <p>Accede a la creación de un horario:</p>
        <p><a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">Crear horario</a></p>
    </div>
    <h2>Horarios</h2>
    <table class="table table-hover">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">Módulo</th>
                <th scope="col">Profesor</th>
                <th scope="col">Día</th>
                <th scope="col">Hora</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{$schedule->module->code}}</td>
                    <td>{{$schedule->module->user->name}} {{$schedule->module->user->lastname}}</td>
                    <td>{{$schedule->day}}</td>
                    <td>{{$schedule->hour}}</td>

                    <td>@php
                    $route = route('admin.schedules.show', $schedule);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip = 'Ver datos de la reunión';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.schedules.edit', $schedule);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = 'Editar datos del horario';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $schedule->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = 'Eliminar reunión';
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                    </td>
                </tr>

                <!-- Modal para eliminar un horario -->
                <div class="modal fade" id="modalSchedule{{ $schedule->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Encabezado del Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmar eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Cuerpo del Modal -->
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar el horario <b>{{ $schedule->name }}</b>? Esta acción no
                                se puede deshacer.
                            </div>

                            <!-- Pie del Modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <!-- Formulario de eliminación -->
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"> Eliminar </button>
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
        {!! $schedules->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection