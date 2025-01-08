@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear nueva asignación</h2>
    <div>
        <p>Accede a la creación de una nueva asignación:</p>
        <p><a href="{{ route('admin.assignments.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
        data-bs-placement="top" title="Crear asignación"><i class="fa-solid fa-plus"></i></a></p>
    </div>
    <h2>Asignaciones</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">Profesor</th>
                <th scope="col">Modulo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
                <tr>
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{$assignment->user->lastname . ', ' . $assignment->user->name }}</td>
                    <td>{{$assignment->module->name}}</td>
                    {{--Acciones--}}
                    <td>
                    @php
                    $route = route('admin.assignments.show', $assignment);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip = 'Ver datos de la asignación';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.assignments.edit', $assignment);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = 'Editar datos de la asignación';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $assignment->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = 'Eliminar asignación';
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                    </td>
                </tr>

                <!-- Modal para eliminar una matricula -->
            <div class="modal fade" id="modal_delete{{ $assignment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del Modal -->
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar esta asignación <b>{{ $assignment->name }}</b>? Esta acción no se puede deshacer.
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('admin.assignments.destroy', $assignment->id) }}" method="POST" enctype="multipart/form-data">
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
        {!! $assignments->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection

