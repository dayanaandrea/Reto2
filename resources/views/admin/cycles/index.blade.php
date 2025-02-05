@extends('layouts.app-admin')
@section('content')
<div class="container">
    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />

    <div class="mb-2 text-end">
        @php
        $route = route('admin.cycles.create');
        $type = "show";
        $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">' . __('cycle.add') . '</span>';
        $tooltip = __('cycle.create_cycle');
        @endphp
        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
    </div>
    <h2>{{__('cycle.cycle')}}</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark ">
                <th scope="col"></th>
                <th scope="col">{{__('cycle.code')}}</th>
                <th scope="col">{{__('cycle.name')}}</th>
                <th scope="col">{{__('cycle.actions')}} </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($cycles as $cycle)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                <td>{{$cycle->code}}</td>
                <td>{{$cycle->name}}</td>

                <td>
                    @php
                    $route = route('admin.cycles.show', $cycle);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip = __('cycle.see_data_cycle');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.cycles.edit', $cycle);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('cycle.edit_data_cycle');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $cycle->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('cycle.delete_cycle');
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                </td>
            </tr>
            <!-- Modal para eliminar un ciclo -->
            @php
            $id = 'modal_delete' . $cycle->id;
            $mensaje =__('cycle.confirm_1') ."<strong class='text-capitalize'>$cycle->name</strong>". __('cycle.confirm_2') ;
            $ruta = route('admin.cycles.destroy', $cycle);
            @endphp
            <x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
            @endforeach
        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $cycles->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection