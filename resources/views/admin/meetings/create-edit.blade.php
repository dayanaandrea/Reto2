@php
if (isset($meeting)) {
$button = __('meeting.update');
$teacher_id = $meeting->teacher_id;
$student_id = $meeting->student_id;
$date = $meeting->date;
$time = $meeting->time;

} else {
$button = __('meeting.create');
$teacher = "";
$student_id = "";
$date = "";
$time = "";
$meeting = null;
}
@endphp

@extends('layouts.app-admin')

@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('meeting.index_title_1') }}</div>

                <div class="card-body">
                    @if($type == 'PUT')
                    <form class="mt-2" name="create_platform" action="{{ route('admin.meetings.update', $meeting) }}"
                        method="POST" enctype="multipart/form-data">

                        @method('PUT')
                        @else
                        <form class="mt-2" name="create_platform" action="{{ route('admin.meetings.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @method('POST')
                            @endif
                            @csrf

                            <h4>{{__('meeting.meeting') }}</h4>

                            <!-- Campo para Profesor -->
                            <div class="row mb-3">
                                <label for="teacher_id" class="col-md-4 col-form-label text-md-end">{{__('meeting.convener')}}</label>
                                <div class="col-md-6">
                                    <select name="teacher_id" id="teacher_id" class="form-select">
                                        <option value="" selected>{{__('meeting.select_convener') }} </option>
                                        @foreach ($teachers as $teacher)
                                        <!-- Esto verifica si la variable $meeting está definida y contiene un valor.
                                    Si estamos creando un nuevo módulo, no existe $meeting por lo que sería false 
                                    y te enseñaria la primera opción --->
                                        <option value="{{ $teacher->id }}"
                                            {{ $teacher->id == old('teacher_id', $meeting->user_id ?? '') ? 'selected' : '' }}>
                                            {{ ucfirst($teacher->name) }} {{ ucfirst($teacher->lastname) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Campo para Estudiante -->
                            <div class="row mb-3">
                                <label for="student_id" class="col-md-4 col-form-label text-md-end">{{__('meeting.participant')}}</label>
                                <div class="form-group col-md-6">
                                    <select id="participants" name="participants[]" class="form-control" multiple>
                                        @if (!is_null($meeting))
                                        @foreach ($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ $meeting->participants?->contains('id', $student->id) ? 'selected' : '' }}>
                                            {{ ucfirst($student->name) }} {{ ucfirst($student->lastname) }}
                                        </option>
                                        @endforeach
                                        @else
                                        @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ ucfirst($student->name) }} {{ ucfirst($student->lastname) }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <!-- Campo para Fecha -->
                            <div class="row mb-3">
                                <label for="day" class="col-md-4 col-form-label text-md-end">{{__('meeting.day') }} </label>

                                <div class="col-md-6">
                                    <input id="day" type="number" min="1" max="5" class="form-control @error('day') is-invalid @enderror" name="day" value="{{ old('day', $meeting->day ?? '') }}" required>

                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo para Hora -->
                            <div class="row mb-3">
                                <label for="time" class="col-md-4 col-form-label text-md-end">{{__('meeting.time') }} </label>

                                <div class="col-md-6">
                                    <input id="time" type="number" min="1" max="6" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time', $meeting->time ?? '') }}" required>

                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo para semana -->
                            <div class="row mb-3">
                                <label for="week" class="col-md-4 col-form-label text-md-end">{{__('meeting.week') }} </label>

                                <div class="col-md-6">
                                    <input id="week" type="number" min="1" max="39" class="form-control @error('week') is-invalid @enderror" name="week" value="{{ old('week', $meeting->week ?? '') }}" required>

                                    @error('week')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campo para Estados (es un enum) -->
                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">{{__('meeting.status') }}</label>

                                <div class="col-md-6">
                                    <select name="status" id="status" class="form-select">
                                        @foreach ($status as $option)
                                        <option value="{{ $option }}" {{ old('status', $meeting->status ?? 'pendiente') === $option ? 'selected' : '' }}>
                                            {{ ucfirst($option) }}
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