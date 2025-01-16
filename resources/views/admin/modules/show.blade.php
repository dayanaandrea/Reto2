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
                <!-- Modal para eliminar un modulo -->
                <div class="modal fade" id="modal_delete{{ $module->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title"> {{__('module.confirm_deletes')}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Cuerpo del Modal -->
                            <div class="modal-body">
                                {{__('module.confirm_1')}}<b>{{ $module->name }}</b>? {{__('module.confirm_2')}}
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('module.cancel')}}</button>
                                <!-- Formulario de eliminación -->
                                <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">{{__('module.delete')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection