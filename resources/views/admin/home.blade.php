    @extends('layouts.app-admin')

    @php
    $user = Auth::user();
    @endphp

    @section('content')
    <div class="container">
        <h2>Home de admin</h2>
        <p>Bienvenido {{$user->name}} {{$user->lastname}}</p>
    </div>

    <div class="container mt-4" id="totales">
        <div class="row">

            <a href="{{ route('admin.users.index', ['role' => 'estudiante']) }}" class="text-decoration-none">
                <div class="card text-white bg-dark mb-4 text-center p-2">
                    <h5 class="card-title fs-1">{{ $totalAlumnos }}</h5>
                    <div class="card-body">
                        Alumnos
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.users.index', ['role' => 'profesor']) }}" class="text-decoration-none">
                <div class="card text-white bg-dark mb-4 text-center p-2">
                    <h5 class="card-title fs-1">{{ $totalPersonal }}</h5>
                    <div class="card-body">
                        Personal
                    </div>
                </div>
            </a>

            <div class="col-md-4">
                <a href="{{ route('admin.meetings.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $reunionesAccepted }}</h5>
                        <div class="card-body">
                            Reuniones aceptadas
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <a href="{{ route('admin.meetings.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $reunionesPendientes }}</h5>
                        <div class="card-body">
                            Reuniones pendientes
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-md-4">
                <a href="{{ route('admin.meetings.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $reunionesTotales }}</h5>
                        <div class="card-body">
                            Reuniones totales
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-md-4">
                <a href="{{ route('admin.cycles.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $totalCiclos }}</h5>
                        <div class="card-body">
                            Número de ciclos formativos
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $usuariosSinRol }}</h5>
                        <div class="card-body">
                            Usuarios sin rol
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.modules.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $totalModulos }}</h5>
                        <div class="card-body">
                            Número de módulos
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endsection