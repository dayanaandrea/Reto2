@extends('layouts.app-admin')

@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />
    <div class="mb-2 text-end">
        @php
            $route = route('admin.meetings.create');
            $type = "show";
            $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">' . __('meeting.añadir') . '</span>';
            $tooltip =  __('meetings.create_meeting');
        @endphp
        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
    </div>
    <h2>{{__('meeting.meeting')}}</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">{{__('meeting.convener')}}</th>
                <th scope="col">{{__('meeting.participant')}}</th>
                <th scope="col">{{__('meeting.day')}}</th>
                <th scope="col">{{__('meeting.time')}} </th>
                <th scope="col">{{__('meeting.week')}} </th>
                <th scope="col">{{__('meeting.status')}}</th>
                <th scope="col">{{__('meeting.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meetings as $meeting)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                <td><a href="{{route('admin.users.show', $meeting->user)}}">{{$meeting->user->name}} {{$meeting->user->lastname}}</a></td>
                <td>
                    @if ($meeting->participants->isEmpty())
                    {{__('meeting.withoutParticipants')}}
                    @else
                        @foreach ($meeting->participants as $participant)
                            {{ $participant->name }}@if (!$loop->last), @endif
                        @endforeach
                    @endif</td>
                <td>{{$meeting->day}}</td>
                <td>{{$meeting->time}}</td>
                <td>{{$meeting->week}}</td>
                <td>{{$meeting->status}}</td>
               
                <td>
                    @php
                    $route = route('admin.meetings.show', $meeting);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip =  __('meeting.see_data_meeting');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.meetings.edit', $meeting);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip =  __('meeting.edit_data_meeting');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $meeting->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('meeting.delete_data_meeting');
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                </td>
            </tr>

            <!-- Modal para eliminar un modulo -->
            <div class="modal fade" id="modal_delete{{ $meeting->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">{{__('meeting.confirm_deletes')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del Modal -->
                        <div class="modal-body">
                        {{__('meeting.confirm_1')}} <b>{{ $meeting->time }}</b>? {{__('meeting.confirm_2')}}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('meeting.cancel')}}</button>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('admin.meetings.destroy', $meeting->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">  {{__('meeting.delete')}} </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $meetings->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection