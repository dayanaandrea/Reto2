@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear nueva matricula</h2>

    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />

    <div>
        <p>Accede a la creación de una matricula:</p>
        <p><a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary"data-bs-toggle="tooltip"
        data-bs-placement="top" title="Crear matricula"><i class="fa-solid fa-plus"></i></a></p>
    </div>
    <h2>Matriculas</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark ">
                <th scope="col"></th>
                <th scope="col">Estudiante</th>
                <th scope="col">Modulo</th>
                <th scope="col">Ciclo </th>
                <th scope="col">Fecha </th>
                <th scope="col">Curso </th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
                <tr >
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{ $enrollment->user->lastname . ', ' . $enrollment->user->name }}</td>
                    <td>{{$enrollment->module->name}}</td>
                    <td>{{$enrollment->cycle->code}}</td>
                    <td>{{$enrollment->date}}</td>
                    <td>{{$enrollment->course}}</td>

                    <td>
                    @php
                    $route = route('admin.enrollments.show', $enrollment);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip = 'Ver datos de la matrícula';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.enrollments.edit', $enrollment);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = 'Editar datos de la matrícula';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $enrollment->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = 'Eliminar matrícula';
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                    </td>
                </tr>

                <!-- Modal para eliminar una matricula -->
            <div class="modal fade" id="modal_delete{{ $enrollment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del Modal -->
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar esta matrícula <b>{{ $enrollment->name }}</b>? Esta acción no se puede deshacer.
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('admin.enrollments.destroy', $enrollment->id) }}" method="POST" enctype="multipart/form-data">
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
        {!! $enrollments->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection