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


    @if($user->role && $user->role->role == 'profesor' && $user->modules)
        <div class="mb-2">
            <h2>Módulos</h2>
            <x-accordions.modules-students :modules="$user->modules" />
        </div>
    @endif

    @if($user->role)
        @if ($user->role->role == 'estudiante')
            <div class="container">
                <h2>Home de estudiante</h2>
                <p>Bienvenido {{ $user->name }} {{ $user->lastname }}</p>
                <div class="container">
                    <!--Mostrar ciclos-->
                    @if($user->enrollments)
                        @php
                            $cycles = $user->enrollments
                                ->map(function ($enrollment) {
                                    return $enrollment->module;
                                })
                                ->sortBy('created_at') // Ordenar los módulos por la fecha de creación
                                ->map(function ($module) {
                                    return $module->cycle; // Ahora extraemos el ciclo después de ordenar
                                })
                                ->unique('id'); // Asegúrate de que los ciclos sean únicos por id
                                
                            $modules = $user->enrollments->map(function ($enrollment) {

                                return $enrollment->module;  // Obtener el módulo de la inscripción
                            });
                        @endphp

                        <div class="container">
                            <h2 class="mb-3">Ciclos</h2>
                            <x-accordions.cycles-for-students :cycles="$cycles" :modules="$modules" />
                        </div>
                    @else
                        Sin matrícula
                    @endif
                </div>
            </div>
        @endif
    @endif
</div>
@endsection