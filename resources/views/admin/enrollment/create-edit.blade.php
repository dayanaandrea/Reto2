@php
    if (isset($enrollment)) {
        $user = $enrollment->student_id;
        $module = $enrollment->module_id;
        $cycle = $enrollment->cycle_id;
        $date = $enrollment->date;
        $course = $enrollment->course;
        $button = "Actualizar";
        $title = "Actualización de la matrícula";
    } else {
        $user = "";
        $module = "";
        $cycle = "";
        $date = "";
        $course = "";
        $button = "Crear";
        $title = "Creación de una matrícula";
    }
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}}</div>

                <div class="card-body">
                    @if($type == 'PUT')
                        <form class="mt-2" name="create_platform" action="{{ route('admin.enrollments.update', $enrollment) }}"
                            method="POST" enctype="multipart/form-data">

                            @method('PUT')
                    @else
                        <form class="mt-2" name="create_platform" action="{{ route('admin.enrollments.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @method('POST')
                    @endif
                            @csrf

                            <h4>Matrícula</h4>

                            {{-- Usuario --}}
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">Alumno</label>
                                <div class="col-md-6">
                                    <select name="user" id="user" class="form-select">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" 
                                                {{ $user->id == old('user', $enrollment->student_id ?? '') ? 'selected' : '' }}>
                                                {{ ucfirst($user->lastname . ', ' . $user->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Módulo --}}
                            <div class="row mb-3">
                                <label for="module" class="col-md-4 col-form-label text-md-end">Módulo</label>
                                <div class="col-md-6">
                                    <select name="module" id="module" class="form-select">
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}" 
                                                {{ $module->id == old('module', isset($enrollment) ? $enrollment->module_id : '') ? 'selected' : '' }}>
                                                {{ ucfirst($module->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Ciclo --}}
                            <div class="row mb-3">
                                <label for="cycle" class="col-md-4 col-form-label text-md-end">Ciclo</label>
                                <div class="col-md-6">
                                    <select name="cycle" id="cycle" class="form-select">
                                        @foreach ($cycles as $cycle)
                                            <option value="{{ $cycle->id }}" 
                                                {{ $cycle->id == old('cycle', isset($enrollment) ? $enrollment->cycle_id : '') ? 'selected' : '' }}>
                                                {{ ucfirst($cycle->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Campo para fecha -->
                            <div class="row mb-3">
                                <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Fecha') }}</label>
                                <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $enrollment->date ?? '') }}" required>

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo para curso -->
                            <div class="row mb-3">
                                <label for="course" class="col-md-4 col-form-label text-md-end">{{ __('Curso') }}</label>

                                <div class="col-md-6">
                                <input id="course" type="course" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course', $enrollment->course ?? '') }}" required>

                                    @error('course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{$button}}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
