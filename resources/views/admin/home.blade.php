@extends('layouts.app-admin')

@php
$user = Auth::user();
@endphp

@section('content')
<div class="container">
    <h2 class="text-center fw-bold">{{ __('home.title_admin') }}</h2>
    <p class="text-center fs-5">{{ __('home.title2_admin') }} <strong>{{ $user->name }} {{ $user->lastname }}</strong></p>
</div>

<div class="container mt-4" id="totales">

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.users.index', ['role' => 'estudiante']) }}" class="text-decoration-none">
                <div class="card text-white bg-primary shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-user-graduate"></i> {{ $totalAlumnos }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.students_admin') }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.users.index', ['role' => 'profesor']) }}" class="text-decoration-none">
                <div class="card text-white bg-success shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-chalkboard-teacher"></i> {{ $totalPersonal }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.personal_admin') }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.users.index', ['role' => 'sin_rol']) }}" class="text-decoration-none">
                <div class="card text-white bg-warning shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-user-times"></i> {{ $usuariosSinRol }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.withOutRol_admin') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.meetings.index', ['status' => 'aceptada']) }}" class="text-decoration-none">
                <div class="card text-white bg-info shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-check-circle"></i> {{ $reunionesAccepted }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.acceptedMeetings_admin') }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.meetings.index', ['status'=>'pendiente']) }}" class="text-decoration-none">
                <div class="card text-white bg-danger shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-clock"></i> {{ $reunionesPendientes }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.pendingMeetings_admin') }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.meetings.index') }}" class="text-decoration-none">
                <div class="card text-white bg-secondary shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-calendar-alt"></i> {{ $reunionesTotales }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.allMeetings_admin') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.modules.index') }}" class="text-decoration-none">
                <div class="card text-white bg-dark shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-book"></i> {{ $totalModulos }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.modules_admin') }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.cycles.index') }}" class="text-decoration-none">
                <div class="card text-white bg-primary shadow-lg rounded-3 mb-4 text-center p-3 hover-effect">
                    <h5 class="card-title fs-1">
                        <i class="fas fa-sync"></i> {{ $totalCiclos }}
                    </h5>
                    <div class="card-body fw-bold">
                        {{ __('home.cycles_admin') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection