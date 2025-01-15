@extends('layouts.app')
@section('content')
@if (Auth::user()->role && Auth::user()->role->role == 'profesor')
<div class="container">
    <h2 class="mb-3">Profesores</h2>
    <table class="table table-striped">
        <thead>
            <tr class="table-dark text-uppercase">
                <th scope="col"></th>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                <td>
                    <div style="width:30px;">
                        <div class="rounded-image-container"
                            style="background-image: url('{{ obtenerFoto($teacher) }}');">
                        </div>
                    </div>
                </td>
                <td>{{$teacher->lastname}}</td>
                <td>{{$teacher->name}}</td>
                <td><a href="mailto:{{$teacher->email}}">{{$teacher->email}}</a></td>
                <td>{{$teacher->phone1}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $teachers->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endif
@endsection