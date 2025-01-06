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
                <th scope="col/"></th>
                <th scope="col">Estudiante</th>
                <th scope="col">Modulo</th>
                <th scope="col">Ciclo </th>
                <th scope="col">Fecha </th>
                <th scope="col">Curso </th>
       
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
                <tr >
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{$cycle->code}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$module->name}}</td>
                    <td>{{$cycle->name}}</td>
                    <td>{{$enrollment->date}}</td>
                    <td>{{$enrollment->course}}</td>
                    
                    <td><a href="{{route('admin.enrollments.show', $enrollment)}}" class="btn btn-secondary btn-sm">
                            Ver
                        </a>
                        <a href="#" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        <!-- Para generar un modal diferente siempre, se debe incluir el id --> 
                        <a href="#" class="btn btn-danger btn-sm" >
                            Eliminar
                        </a>
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