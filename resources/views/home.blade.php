@extends('layouts.app')

@php
    $user = Auth::user();
@endphp

@section('content')
<div class="container">
    @if(session('permission'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('permission') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($user->role)
        @if ($user->role->role == 'profesor')
            <h2 class="mb-3">Profesores</h2>
            <table class="table table-striped">
                <thead>
                    <tr class="table-dark text-uppercase">
                        <th scope="col"></th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td><img src="{{obtenerFoto($user)}}" alt="profile_img" class="img-fluid rounded-circle"
                                    style="max-width: 30px; max-height: 30px;"></td>
                            <td>{{$teacher->lastname}}</td>
                            <td>{{$teacher->name}}</td>
                            <td>{{$teacher->email}}</td>
                            <td>
                                @php
                                    $route = route('users.show', $teacher);
                                    $type = "show";
                                    $text = '<i class="fa-solid fa-eye"></i>';
                                    $tooltip = 'Ver datos del usuario';
                                @endphp
                                <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Paginación -->
            <div>
                {!! $teachers->links('vendor.pagination.bootstrap-5') !!}
            </div>
        @elseif ($user->role->role == 'estudiante')
            <div class="container">
                <h2>Home de estudiante</h2>
                <p>Bienvenido {{ $user->name }} {{ $user->lastname }}</p>
            </div>
        @endif
    @endif
</div>
@endsection