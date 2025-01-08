@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear nueva asignación</h2>
    <div>
        <p>Accede a la creación de una nueva asignación:</p>
        <p><a href="{{ route('admin.assignments.create') }}" class="btn btn-primary">Crear asignación</a></p>
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
                    <td>{{$assignment->user->name . ', ' . $assignment->user->lastname }}</td>
                    <td>{{$assignment->module->name}}</td>
                    {{--Acciones--}}
                    <td>
                        <a href="{{ route('admin.assignments.show', $assignment) }}" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="{{ route('admin.assignments.edit', $assignment) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.assignments.destroy', $assignment) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta asignación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $assignments->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection

