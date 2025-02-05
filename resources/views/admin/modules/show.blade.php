@extends('layouts.app-admin')
@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />

    <h2 class="mb-4">{{__('module.show_title')}}</h2>

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

                <div>
                    <!-- Los botones de las operaciones CRUD solo aparecen para los god y admin -->
                    @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                    @php
                    $route = route('admin.modules.edit', $module);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('module.edit_data_module');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    @php
                    $id_modal = '#modal_delete' . $module->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('module.delete_module');
                    @endphp

                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                    @endif
                </div>
            </div>
            @php
            $id = 'modal_delete' . $module->id;
            $mensaje = "¿Estás seguro de que deseas eliminar el modulo <strong class='text-capitalize'>$module->name</strong>? Esta acción no se puede deshacer.";
            $ruta = route('admin.modules.destroy', $module);
            @endphp
            <x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
        </div>

    </div>
</div>
@endsection