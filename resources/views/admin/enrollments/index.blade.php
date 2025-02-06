@extends('layouts.app-admin')

@section('content')
<div class="container">

    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />

    {{-- Boton para añadir matrículas --}}
    <div class="mb-2 text-end">
        @php
        $route = route('admin.enrollments.create');
        $type = "show";
        $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">' . __('enrollment.add') . '</span>';
        $tooltip = __('enrollment.tp_create');
        @endphp
        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
    </div>

    <h2>{{__('enrollment.enrollments')}}</h2>
    <table class="table table-hover table-striped table-responsive">
        <thead>
            <tr class="text-uppercase table-dark ">
                <th scope="col"></th>
                <th scope="col">{{__('enrollment.student')}}</th>
                <th scope="col">{{__('enrollment.module')}}</th>
                <th scope="col">{{__('enrollment.cycle')}}</th>
                <th scope="col">{{__('enrollment.course')}}</th>
                <th scope="col">{{__('enrollment.date')}}</th>
                <th scope="col">{{__('enrollment.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                <td><a
                        href="{{route('admin.users.show', $enrollment->user)}}">{{ $enrollment->user->name . ' ' . $enrollment->user->lastname }}</a>
                </td>
                <td>{{$enrollment->module->name}}</td>
                <td>{{$enrollment->module->cycle->code}}</td>
                <td>{{$enrollment->module->course}}</td>
                <td>{{ date('d-m-Y', strtotime($enrollment->created_at)) }}</td>
                <td>
                    @php
                    $route = route('admin.enrollments.show', $enrollment);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip = __('enrollment.see_data_enrollment');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.enrollments.edit', $enrollment);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('enrollment.edit_data_enrollment');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $enrollment->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('enrollment.delete_data_enrollment');
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                </td>
            </tr>

            <!-- Modal para eliminar un ciclo -->
            @php
            $id = 'modal_delete' . $enrollment->id;
            $mensaje =__('enrollment.ask_for_delete_confirmation_1') . __('enrollment.ask_for_delete_confirmation_2') ;
            $ruta = route('admin.enrollments.destroy', $enrollment);
            @endphp
            <x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $enrollments->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection