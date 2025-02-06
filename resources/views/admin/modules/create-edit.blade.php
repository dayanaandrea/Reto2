@php
if (isset($module)) {
$code = $module->code;
$name = $module->name;
$hours = $module->hours;
$course = $module->course;
$cycle_id = $module->cycle_id;
$button = __('module.update');
$title = __('module.update_text');
} else {
$code = "";
$name = "";
$hours = "";
$course = "";
$cycle_id = "";
$button = __('module.create');
$title = __('module.create_text');
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
                                <label for="code" class="col-md-4 col-form-label text-md-end">{{__('module.code')}}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text"
                                        class="form-control @error('code') is-invalid @enderror" name="code"
                                        value="{{ old('code', $code) }}" autocomplete="code" autofocus>

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class=" row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{__('module.name')}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $name) }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="hours" class="col-md-4 col-form-label text-md-end">{{__('module.hours')}}</label>
                                <div class="col-md-6">
                                    <input id="hours" type="number" class="form-control @error('hours') is-invalid @enderror" name="hours" value="{{ old('hours', $hours) }}" autocomplete="hours">

                                    @error('hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="course" class="col-md-4 col-form-label text-md-end">{{__('module.course')}}</label>
                                <div class="col-md-6">
                                    <input id="course" type="number" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course', $course) }}" autocomplete="course">
                                    @error('course')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cycle_id" class="col-md-4 col-form-label text-md-end">{{__('module.cycle')}}</label>
                                <div class="col-md-6">
                                    <select name="cycle_id" id="cycle_id" class="form-select">
                                        @foreach ($cycles as $cycle)
                                        <option value="{{ $cycle->id }}">
                                            {{ ucfirst($cycle->code) }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user_id" class="col-md-4 col-form-label text-md-end">{{__('module.teacher')}}</label>
                                <div class="col-md-6">
                                    <select name="user_id" id="user_id" class="form-select">
                                        <option value="" selected>{{__('module.select_teacher')}}</option>
                                        @foreach ($users as $user)
                                        <!-- Esto verifica si la variable $module está definida y contiene un valor.
                                        Si estamos creando un nuevo módulo, no existe $module por lo que sería false 
                                        y te enseñaria la primera opción --->
                                        <option value="{{ $user->id }}"
                                            @if(isset($module) && $module->user_id == $user->id) selected @endif>
                                            {{ ucfirst($user->name) }} {{ ucfirst($user->lastname) }}
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