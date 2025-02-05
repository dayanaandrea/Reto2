@extends('layouts.app-admin')
@section('content')
<div class="container">
    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'permission'" :class="'danger'" />
    <x-alert :key="'error'" :class="'danger'" />

    <div class="mb-2 text-end">
        @php
        $route = route('admin.modules.create');
        $type = "show";
        $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">' . __('module.add') . '</span>';
        $tooltip = __('module.create_module');
        @endphp
        <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
    </div>
    <h2>{{__('module.module')}}</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr class="text-uppercase table-dark">
                <th scope="col"></th>
                <th scope="col">{{__('module.code')}}</th>
                <th scope="col">{{__('module.name')}}</th>
                <th scope="col">{{__('module.hours')}}</th>
                <th scope="col">{{__('module.course')}} </th>
                <th scope="col">{{__('module.cycle')}}</th>
                <th scope="col">{{__('module.teacher')}}</th>
                <th scope="col">{{__('module.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $module)
            <tr>
                <th scope="col">{{ $loop->iteration }}</th>
                <td>{{$module->code}}</td>
                <td>{{$module->name}}</td>
                <td>{{$module->hours}}</td>
                <td>{{$module->course}}</td>
                <td>{{$module->cycle->code}}</td>
                @if ($module->user)
                <td><a href="{{route('admin.users.show', $module->user)}}">{{$module->user->name}}
                        {{$module->user->lastname}}</a></td>
                @else
                <td>{{__('module.not_assigned')}}</td>
                @endif
                <td>
                    @php
                    $route = route('admin.modules.show', $module);
                    $type = "show";
                    $text = '<i class="fa-solid fa-eye"></i>';
                    $tooltip = __('module.see_data_module');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.modules.edit', $module);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('module.edit_data_module');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $module->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip = __('module.delete_module');
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                </td>
            </tr>

            <!-- Modal para eliminar un ciclo -->
            @php
            $id = 'modal_delete' . $module->id;
            $mensaje =__('module.confirm_1') ."<strong class='text-capitalize'>$module->name</strong>". __('module.confirm_2') ;
            $ruta = route('admin.modules.destroy', $module);
            @endphp
            <x-modals.delete :id="$id" :mensaje="$mensaje" :ruta="$ruta" />
            @endforeach

        </tbody>
    </table>
    <!-- Paginación -->
    <div>
        {!! $modules->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection