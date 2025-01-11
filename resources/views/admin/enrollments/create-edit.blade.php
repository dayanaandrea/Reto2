@php
    if (isset($enrollment)) {
        $user = $enrollment->user_id;
        $module = $enrollment->module_id;
        $date = $enrollment->date;
        $button = __('enrollment.update');
        $title = __('enrollment.update_enrollment');
    } else {
        $user = "";
        $module = "";
        $date = "";
        $button = __('enrollment.create');
        $title = __('enrollment.create_enrollment');
    }
@endphp

@extends('layouts.app-admin')

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

                            <h4>{{__('enrollment.enrollment')}}</h4>
                            
                            {{-- Usuario --}}
                            <div class="row mb-3">
                                <label for="user_id" class="col-md-4 col-form-label text-md-end">{{__('enrollment.student')}}</label>
                                <div class="col-md-6">
                                <select name="user_id" id="user" class="form-select">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" 
                                            {{ $user->id == old('user_id', $enrollment->user_id ?? '') ? 'selected' : '' }}>
                                            {{ ucfirst($user->lastname . ', ' . $user->name) }}
                                        </option>
                                    @endforeach
                                </select>

                                </div>
                            </div>

                            {{-- Módulo --}}
                            <div class="row mb-3">
                                <label for="module_id" class="col-md-4 col-form-label text-md-end">{{__('enrollment.module')}}</label>
                                <div class="col-md-7">
                                <select name="module_id[]" id="module" class="form-select" multiple size="20">
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}" 
                                                {{ $module->id == old('module_id', isset($enrollment) ? $enrollment->module_id : '') ? 'selected' : '' }}>
                                                {{ ucfirst('('. $module->cycle->code ."-". $module->course  . ')'." " . $module->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Campo para fecha -->
                            <div class="row mb-3">
                                <label for="date" class="col-md-4 col-form-label text-md-end">{{__('enrollment.date')}}</label>
                                <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $enrollment->date ?? '') }}" required>

                                    @error('date')
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
