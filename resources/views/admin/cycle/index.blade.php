@extends('layouts.app')

@section('content')
<div class="container">
     <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
     @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('permission'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('permission') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2>Crear un nuevo ciclo</h2>
    <div>
        <p>Accede a la creación de ciclo:</p>
        <p><a href="{{ route('admin.cycles.create') }}" class="btn btn-primary">Crear ciclo</a></p>
    </div>
    <h2>Ciclos</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark ">
                <th scope="col/"></th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones </th>
       
            </tr>
        </thead>
        <tbody>
            @foreach ($cycles as $cycle)
                <tr >
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{$cycle->code}}</td>
                    <td>{{$cycle->name}}</td>
                    
                    <td><a href="{{route('admin.cycles.show', $cycle)}}" class="btn btn-secondary btn-sm">
                            Ver
                        </a>
                        <a href="#" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        <!-- Para generar un modal diferente siempre, se debe incluir el id --> 
                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalCycle{{$cycle->id}}"
                        data-cycle-id="{{ $cycle->id }}">
                            Eliminar
                        </a>
                    </td>
                </tr>
                <!-- Modal para eliminar un ciclo -->
                <div class="modal fade" id="modalCycle{{$cycle->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
        {!! $cycles->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection