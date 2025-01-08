@php
    if (isset($schedule)) {
        $name = $schedule->schedule;
        $description = $schedule->description;
        $button = "Actualizar";
        $title = "Actualización del Horario";
    } else {
        $name = "";
        $description = "";
        $button = "Crear";
        $title = "Creación de horarios";
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
                        <form class="mt-2" name="create_platform" action="{{ route('admin.schedules.update', $schedule) }}"
                            method="POST" enctype="multipart/form-data">

                            @method('PUT')
                    @else
                        <form class="mt-2" name="create_platform" action="{{ route('admin.schedules.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @method('POST')
                    @endif
                            @csrf

                            <h4>Detalles del horario</h4>
                            <div class=" row mb-3">
                                <label for="schedule" class="col-md-4 col-form-label text-md-end">Schedule</label>

                                <div class="col-md-6">
                                    <input id="schedule" type="text"
                                        class="form-control @error('schedule') is-invalid @enderror" name="schedule"
                                        value="{{ old('schedule', $name) }}" required autocomplete="schedule" autofocus>

                                    @error('schedule')
                                        <span class="invalid-feedback" schedule="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Descripción</label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description" required autocomplete="description"
                                        autofocus>{{ old('description', $description) }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" schedule="alert">
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