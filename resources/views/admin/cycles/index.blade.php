@extends('layouts.app-admin')
@section('content')
<div class="container">
    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />

    <h2>Crear un nuevo ciclo</h2>
    <div>
        <p>Accede a la creación de ciclo:</p>
        <p><a href="{{ route('admin.cycles.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Crear un nuevo ciclo"><i class="fa-solid fa-plus"></i></a></p>

    </div>
    <h2>Ciclos</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark ">
                <th scope="col"></th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($cycles as $cycle)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                <td>{{$cycle->code}}</td>
                <td>{{$cycle->name}}</td>

                <td>
                    @php
                    $route = route('admin.cycles.show', $cycle);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip = 'Ver datos del ciclo';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.cycles.edit', $cycle);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = 'Editar datos del ciclo';
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $cycle->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = 'Eliminar ciclo';
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                </td>
            </tr>
            <!-- Modal para eliminar un ciclo -->
            <div class="modal fade" id="modal_delete{{$cycle->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del Modal -->
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar el ciclo <b>{{ $cycle->name }}</b>? Esta acción no se puede deshacer.
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('admin.cycles.destroy', $cycle->id) }}" method="POST" enctype="multipart/form-data">
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
        {!! $cycles->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection