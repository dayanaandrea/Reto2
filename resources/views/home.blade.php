@extends('layouts.app')

@php
$user = Auth::user();
@endphp

@section('content')
<div class="container">
    @if ($user->role->role == 'profesor')
    <h2 class="mb-3">Profesores</h2>
    <table class="table table-striped">
        <thead>
            <tr class="table-dark text-uppercase">
                <th scope="col">#</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                <td>{{$teacher->lastname}}</td>
                <td>{{$teacher->name}}</td>
                <td>{{$teacher->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @elseif ($user->role->role == 'estudiante')
    <div class="container">
        <h2>Home de estudiante</h2>
        <p>Bienvenido {{ $user->name }} {{ $user->lastname }}</p>
    </div>
    @endif
</div>
@endsection