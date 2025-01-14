@extends('layouts.app-admin')

@section('content')
<div class="container">

    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />

    <h2 class="mb-4">{{__('enrollment.title_show_1')}}</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{__('enrollment.title_show_2')}}{{ $enrollment->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">{{__('enrollment.student')}}</p>
                <p class="col-sm-9">{{$enrollment->user->name . ', ' . $enrollment->user->lastname}}</p>
                
                <p class="col-sm-3 fw-bold">{{__('enrollment.module')}}</p>
                <p class="col-sm-9">{{$enrollment->module->name }}</p>

                <p class="col-sm-3 fw-bold">{{__('enrollment.cycle')}}</p>
                <p class="col-sm-9">{{$enrollment->module->cycle->name}} ({{$enrollment->module->cycle->code}})</p>

                <p class="col-sm-3 fw-bold">{{__('enrollment.date')}}</p>
                <p class="col-sm-9">{{$enrollment->date}}</p>

                <p class="col-sm-3 fw-bold">{{__('enrollment.course')}}</p>
                <p class="col-sm-9">{{$enrollment->module->course }}</p>

                <!-- Botones de Editar y Eliminar -->
                <div class="mt-4">
                    @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                        @php
                        $routeEdit = route('admin.enrollments.edit', $enrollment);
                        $typeEdit = "edit";
                        $textEdit = '<i class="fa-solid fa-pen"></i>';
                        $tooltipEdit = 'Editar datos de la matrícula';

                        $id_modal = 'modal_delete' . $enrollment->id;
                        $textDelete = '<i class="fa-solid fa-trash-can"></i>';
                        $tooltipDelete = 'Eliminar matrícula';
                        @endphp
                        
                        <x-buttons.generic :route="$routeEdit" :type="$typeEdit" :text="$textEdit" :tooltip="$tooltipEdit" />
                        <x-buttons.open-modal :id="$id_modal" :text="$textDelete" :type="'danger'" :tooltip="$tooltipDelete" />
                    @endif
                </div>

                <!-- Modal para eliminar la matrícula -->
                <div class="modal fade" id="modal_delete{{ $enrollment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">{{__('enrollment.delete_confirmation')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del Modal -->
                        <div class="modal-body">
                        {{__('enrollment.ask_for_delete_confirmation_1')}} <b>{{ $enrollment->name }}</b>{{__('enrollment.ask_for_delete_confirmation_2')}}                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('enrollment.cancel')}}</button>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('admin.enrollments.destroy', $enrollment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"> {{__('enrollment.delete')}} </button>
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
