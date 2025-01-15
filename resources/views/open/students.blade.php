@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />

    @if ($students->count() > 0)
    <h2>Estudiantes</h2>
    <div>
        <table class="table table-hover table-striped lista">
            <thead>
                <tr class="text-uppercase table-dark">
                    <th scope="col"></th>
                    <th scope="col">{{ __('user.name') }}</th>
                    <th scope="col">{{ __('user.email') }}</th>
                    <th scope="col">Ciclo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>
                        <div style="width:30px;">
                            <div class="rounded-image-container"
                                style="background-image: url('{{ obtenerFoto($student) }}');">
                            </div>
                        </div>
                    </td>
                    <td>{{$student->name}} {{$student->lastname}}</td>
                    <td><a href="mailto:{{$student->email}}">{{$student->email}}</a></td>
                    <td>
                        @if($student->enrollments)
                            @php
                                // Obtener los ciclos únicos, porque sino se printean de forma repetida
                                $uniqueCycles = $student->enrollments->pluck('module.cycle.name')->unique();
                            @endphp

                            @foreach ($uniqueCycles as $cycleName)
                                {{ $cycleName }}
                            @endforeach
                        @else
                            Sin matrícula
                        @endif
                    </td>
                    @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
        <div>
            {!! $students->links('vendor.pagination.bootstrap-5') !!}
        </div>
    </div>
    @endif
</div>
@endsection