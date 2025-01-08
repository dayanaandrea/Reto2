@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear nueva matricula</h2>
    <div>
        <p>Accede a la creación de una matricula:</p>
        <p><a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary">Crear matricula</a></p>
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
                        <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="{{ route('admin.enrollments.edit', $enrollment) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta matrícula?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $enrollments->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection