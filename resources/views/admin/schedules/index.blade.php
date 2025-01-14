@extends('layouts.app-admin')

@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <div class="mb-2 text-end">
        @php
            $route = route('admin.schedules.create');
            $type = "show";
            $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">Añadir</span>';
            $tooltip =  __('schedule.create_schedule');
        @endphp
        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
    </div>
    <h2>Horarios</h2>
    <table class="table table-hover table-striped">
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
                    @if ($schedule->module->user)
                                <td><a href="{{route('admin.schedules.show', $schedule->module->user)}}">{{$schedule->module->user->name}}
                                        {{$schedule->module->user->lastname}}</a></td>
                            @else
                                <td>{{__('module.not_assigned')}}</td>
                            @endif
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
                <div class="modal fade" id="modal_delete{{ $schedule->id }}" tabindex="-1"
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
                                ¿Estás seguro de que deseas eliminar el horario <b>{{ $schedule->day }}</b>? Esta acción no
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