@extends('layouts.app-admin')
@section('content')
<div class="container">
    <h2 class="mb-4">{{__('module.show_title')}}</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $module->name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">{{__('module.code')}}</p>
                <p class="col-sm-9">{{ $module->code }}</p>

                <p class="col-sm-3 fw-bold">{{__('module.hours')}}</p>
                <p class="col-sm-9">{{ $module->hours }}</p>

                <p class="col-sm-3 fw-bold">{{__('module.course')}}</p>
                <p class="col-sm-9">{{ $module->course }} </p>

                <p class="col-sm-3 fw-bold">{{__('module.cycle')}}</p>
                <p class="col-sm-9">{{ $module->cycle->code }} {{ $module->cycle->name }}</p>

                <p class="col-sm-3 fw-bold">{{__('module.teacher')}}</p>
                @if ($module->user)
                    <p class="col-sm-9"><a href="{{route('admin.users.show', $module->user)}}">{{$module->user->name}}
                            {{$module->user->lastname}}</a></p>
                @else
                    <p class="col-sm-9">{{__('module.not_assigned')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection