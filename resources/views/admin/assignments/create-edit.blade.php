@php
    if (isset($assignment)) {
        $user = $assignment->user_id;
        $module = $assignment->module_id;
        $button = "Actualizar";
        $title = "Actualización de la asignación";
    } else {
        $user = "";
        $module = "";
        $button = "Crear";
        $title = "Creación de la asignación";
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
                        <form class="mt-2" name="create_platform" action="{{ route('admin.assignments.update', $assignment) }}"
                            method="POST" enctype="multipart/form-data">

                            @method('PUT')
                    @else
                        <form class="mt-2" name="create_platform" action="{{ route('admin.assignments.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @method('POST')
                    @endif
                            @csrf

                            <h4>Asignación</h4>
                            <div class=" row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">Profesor</label>

                                <div class="col-md-6">
                                    <select name="user" id="user" class="form-select">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == old('user', $user) ? 'selected' : '' }}>
                                                {{ ucfirst($user->lastname . ', ' . $user->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                
                                
                            </div>

                            <div class="row mb-3">
                                <label for="module" class="col-md-4 col-form-label text-md-end">Módulo</label>

                                <div class="col-md-6">
                                    <select name="module" id="module" class="form-select">
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}" {{ $module->id == old('module', $module) ? 'selected' : '' }}>
                                                {{ ucfirst($module->name) }}
                                            </option>
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
