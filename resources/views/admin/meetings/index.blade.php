@extends('layouts.app')


@section('content')
<div class="container">
    <h2>Reuniones</h2>
    <table class="table table-hover">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Horas</th>
                <th scope="col">Curso </th>
                <th scope="col">Ciclo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meetings as $meeting)
                <tr >
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{$meeting->code}}</td>
                    <td>{{$meeting->name}}</td>
                    <td>{{$meeting->hours}}</td>
                    <td>{{$meeting->course}}</td>
                    
                    <td><a href= "#" class="btn btn-secondary btn-sm">
                            Ver
                        </a>
                        <a href="#" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        <!-- Para generar un modal diferente siempre, se debe incluir el id --> 
                        <a href="#" class="btn btn-danger btn-sm">
                            Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $meetings->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection