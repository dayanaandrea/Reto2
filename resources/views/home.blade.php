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
    @if($user->role->role == 'estudiante')
        <div id="carousel" class="carousel slide mb-5">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{Storage::url('public/images/estudiantes.jpg')}}" class="d-block w-100 img-fluid"
                        alt="estudiantes">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>¿Qué es lo siguiente?</h5>
                        <p>ElorAdmin te ayuda a planear tu semana.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{Storage::url('public/images/programacion.jpg')}}" class="d-block w-100 img-fluid"
                        alt="programacion">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>¡Empieza a programar!</h5>
                        <p>Elorrieta-Errekamari ofrece diferentes ciclos para aprender a programar.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{Storage::url('public/images/lab.jpg')}}" class="d-block w-100 img-fluid" alt="laboratorio">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>¿Te gusta la ciencia?</h5>
                        <p>En Elorrieta-Errekamari puedes convertirte en Técnico de Laboratorio.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif

    @if($user->role && ($user->role->role == 'profesor' || $user->role->role == 'estudiante'))
        @php
            if ($user->role->role == 'profesor') {
                $schedules = $user->teacherSchedules;
            } else {
                $schedules = $user->studentSchedules;
            }
        @endphp

        @if(!$schedules->isEmpty())
            <div class="mb-5">
                <h2 class="mb-3">Horario</h2>
                <x-tables.schedule :schedules="$schedules" />
            </div>
        @endif
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