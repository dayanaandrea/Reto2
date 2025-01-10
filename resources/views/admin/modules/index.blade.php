@extends('layouts.app-admin')
@section('content')
<div class="container">
    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />

    <h2>Crear un nuevo modulo</h2>
    <div>
        <p>Accede a la creación de un modulo:</p>
        <p><a href="{{ route('admin.modules.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Crear un nuevo modulo"><i class="fa-solid fa-plus"></i></a></p>
    </div>
    <h2>Modulos</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Horas</th>
                <th scope="col">Curso </th>
                <th scope="col">Ciclo</th>
                <th scope="col">Profesor</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $module)
                        <tr>
                            <th scope="col">{{ $loop->iteration }}</th>
                            <td>{{$module->code}}</td>
                            <td>{{$module->name}}</td>
                            <td>{{$module->hours}}</td>
                            <td>{{$module->course}}</td>
                            <td>{{$module->cycle->code}}</td>
                            @if ($module->user)
                                <td><a href="{{route('admin.users.show', $module->user)}}">{{$module->user->name}}
                                        {{$module->user->lastname}}</a></td>
                            @else
                                <td>No asignado</td>
                            @endif
                            <td>
                                @php
                                    $route = route('admin.modules.show', $module);
                                    $type = "show";
                                    $text = '<i class="fa-solid fa-eye"></i>';
                                    $tooltip = 'Ver datos del modulo';
                                @endphp
                                <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                                @php
                                    $route = route('admin.modules.edit', $module);
                                    $type = "edit";
                                    $text = '<i class="fa-solid fa-pen"></i>';
                                    $tooltip = 'Editar datos del modulo';
                                @endphp
                                <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                                <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                                @php
                                    $id_modal = '#modal_delete' . $module->id;
                                    $text = '<i class="fa-solid fa-trash-can"></i>';
                                    $tooltip = 'Eliminar modulo';
                                @endphp
                                <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                            </td>
                        </tr>

                        <!-- Modal para eliminar un modulo -->
                        <div class="modal fade" id="modal_delete{{ $module->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Cuerpo del Modal -->
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar el módulo <b>{{ $module->name }}</b>? Esta acción no se
                                        puede deshacer.
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <!-- Formulario de eliminación -->
                                        <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST"
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
        {!! $modules->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection