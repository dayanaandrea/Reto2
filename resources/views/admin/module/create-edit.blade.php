@php
if (isset($module)) {
$code = $module->code;
$name = $module->name;
$hours = $module->hours;
$course = $module->course;
$cycle_id = $module->cycle_id;
$button = "Actualizar";
$title = "Actualización del Modulo";
} else {
$code = "";
$name = "";
$hours = "";
$course = "";
$cycle_id = "";
$button = "Crear";
$title = "Creación de Modulo";
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
                    <form class="mt-2" name="create_platform" action="{{ route('admin.modules.update', $module) }}"
                        method="POST" enctype="multipart/form-data">

                        @method('PUT')
                        @else
                        <form class="mt-2" name="create_platform" action="{{ route('admin.modules.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @method('POST')
                            @endif
                            @csrf

                            <h4>Modulo</h4>
                            <div class=" row mb-3">
                                <label for="code" class="col-md-4 col-form-label text-md-end">Código</label>

                                <div class="col-md-6">
                                    <input id="code" type="text"
                                        class="form-control @error('code') is-invalid @enderror" name="code"
                                        value="{{ old('code', $code) }}" required autocomplete="code" autofocus>

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class=" row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="hours" class="col-md-4 col-form-label text-md-end">Horas</label>
                                <div class="col-md-6">
                                    <input id="hours" type="number" class="form-control @error('hours') is-invalid @enderror" name="hours" value="{{ old('hours', $hours) }}" required autocomplete="hours">

                                    @error('hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="course" class="col-md-4 col-form-label text-md-end">Curso</label>
                                <div class="col-md-6">
                                    <input id="course" type="number" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course', $course) }}" required autocomplete="course">
                                    @error('course')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                            <label for="cycle_id" class="col-md-4 col-form-label text-md-end">Ciclo</label>
                                <div class="col-md-6">
                                    <select name="cycle_id" id="cycle_id" class="form-select">
                                        @foreach ($cycles as $cycle)
                                        <option value="{{$cycle->cycle_id}}">{{ucfirst($cycle->code)}}</option>
                                        @endforeach
                                    </select>
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