@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear un nuevo modulo</h2>
    <div>
        <p>Accede a la creación de un modulo:</p>
        <p><a href="{{ route('admin.modules.create') }}" class="btn btn-primary">Crear modulo</a></p>
    </div>
    <h2>Modulos</h2>
    <table class="table table-hover">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Horas</th>
                <th scope="col">Curso </th>
                <th scope="col">Ciclo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $module)
                <tr >
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{$module->code}}</td>
                    <td>{{$module->name}}</td>
                    <td>{{$module->hours}}</td>
                    <td>{{$module->course}}</td>
                    <td>{{$module->cycle->code}}</td>
                    
                    <td><a href="{{route('admin.modules.show', $module)}}" class="btn btn-secondary btn-sm">
                            Ver
                        </a>
                        <a href="#" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalModule{{$module->id}}"
                    data-module-id="{{ $module->id }}">
                        Eliminar
                    </a>
                </td>
            </tr>

            <!-- Modal para eliminar un modulo -->
            <div class="modal fade" id="modalModule{{ $module->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Encabezado del Modal -->
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del Modal -->
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar el módulo <b>{{ $module->name }}</b>? Esta acción no se puede deshacer.
                        </div>

                        <!-- Pie del Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" > Eliminar </button>
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