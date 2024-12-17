@extends('layouts.app')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="container">
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
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $modules)
                <tr class="{{$clase}}">
                    <th scope="col">{{ $loop->iteration }}</th>
                    <td>{{$module->code}}</td>
                    <td>{{$module->name}}</td>
                    <td>{{$module->hours}}</td>
                    <td>{{$module->course}}</td>
                    
                    <td><a href="#" class="btn btn-secondary btn-sm">
                            Ver
                        </a>
                        <a href="#" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $users->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection