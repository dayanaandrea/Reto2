@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear un nuevo ciclo</h2>
    <div>
        <p>Accede a la creación de ciclo:</p>
        <p><a href="{{ route('admin.cycles.create') }}" class="btn btn-primary">Crear ciclo</a></p>
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
        {!! $cycles->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection