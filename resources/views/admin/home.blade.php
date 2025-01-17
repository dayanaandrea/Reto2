    @extends('layouts.app-admin')

    @php
    $user = Auth::user();
    @endphp

    @section('content')
    <div class="container">
        <h2>{{__('home.title_admin')}}</h2>
        <p>{{__('home.title2_admin')}} {{$user->name}} {{$user->lastname}}</p>
    </div>

    <div class="container mt-4" id="totales">
        
        <div class="row">

            <div class="col-md-4">
                <a href="{{ route('admin.users.index', ['role' => 'estudiante']) }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $totalAlumnos }}</h5>
                        <div class="card-body">
                        {{__('home.students_admin')}}
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.users.index', ['role' => 'profesor']) }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $totalPersonal }}</h5>
                        <div class="card-body">
                        {{__('home.personal_admin')}}
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.users.index', ['role' => 'sin_rol']) }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $usuariosSinRol }}</h5>
                        <div class="card-body">
                        {{__('home.withOutRol_admin')}} 
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <a href="{{ route('admin.meetings.index', ['status' => 'accepted']) }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $reunionesAccepted }}</h5>
                        <div class="card-body">
                        {{__('home.acceptedMeetings_admin')}}
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.meetings.index', ['status' => 'pending']) }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $reunionesPendientes }}</h5>
                        <div class="card-body">
                        {{__('home.pendingMeetings_admin')}}
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.meetings.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $reunionesTotales }}</h5>
                        <div class="card-body">
                        {{__('home.allMeetings_admin')}}
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <a href="{{ route('admin.modules.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $totalModulos }}</h5>
                        <div class="card-body">
                        {{__('home.modules_admin')}}
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.cycles.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark mb-4 text-center p-2">
                        <h5 class="card-title fs-1">{{ $totalCiclos }}</h5>
                        <div class="card-body">
                        {{__('home.cycles_admin')}}
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endsection