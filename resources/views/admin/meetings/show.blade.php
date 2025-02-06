@extends('layouts.app-admin')

@section('content')
<div class="container">
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />
    <h2 class="mb-4">{{__('meeting.show_title')}}</h2>

    <!-- Tarjeta para mostrar detalles de los modulos -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$meeting->user->name}} {{$meeting->user->lastname}}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-sm-3 fw-bold">{{__('meeting.day')}}:</p>
                <p class="col-sm-9">{{ $meeting->day }}</p>

                <p class="col-sm-3 fw-bold">{{__('meeting.time')}}:</p>
                <p class="col-sm-9">{{ $meeting-> time }}</p>

                <p class="col-sm-3 fw-bold">{{__('meeting.week')}}:</p>
                <p class="col-sm-9">{{ $meeting-> week }}</p>

                <p class="col-sm-3 fw-bold">{{__('meeting.status')}}:</p>
                <p class="col-sm-9">{{ $meeting-> status }} </p>

                <p class="col-sm-3 fw-bold">{{__('meeting.convener')}}:</p>
                <p class="col-sm-9">{{$meeting->user->name}} {{$meeting->user->lastname}}</p>

                <p class="col-sm-3 fw-bold">{{__('meeting.student')}}:</p>
                <p class="col-sm-9">@if ($meeting->participants->isEmpty())
                    {{__('meeting.withoutParticipants')}}
                    @else
                    @foreach ($meeting->participants as $participant)
                    {{ $participant->name }} {{ $participant->lastname }}@if (!$loop->last), @endif
                    @endforeach
                    @endif</td>
                </p>

                <div>
                    <!-- Los botones de las operaciones CRUD solo aparecen para los god y admin -->
                    @if(Auth::user()->role && (Auth::user()->role->role === 'administrador' || Auth::user()->role->role === 'god'))
                    @php
                    $route = route('admin.meetings.edit', $meeting);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('meeting.edit_data_meeting');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    @php
                    $id_modal = '#modal_delete' . $meeting->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('meeting.delete_meeting');
                    @endphp

                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal para eliminar una reunión-->
@php
$id = 'modal_delete' . $meeting->id;
$mensaje = __('meeting.confirm_1') . "<strong>$meeting->name</strong>" . __('meeting.confirm_2');
$ruta = route('admin.meetings.destroy', $meeting);
@endphp
<x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
@endsection