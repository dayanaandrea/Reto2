@extends('layouts.app-admin')
@section('content')
<div class="container">
    <!-- Esto se usa para llamar a un componente que renderiza una alerta -->
    <x-alert :key="'success'" :class="'success'" />

    <div class="mb-2 text-end">
        @php
            $route = route('admin.cycles.create');
            $type = "show";
            $text = '<i class="fa-solid fa-plus"></i><span class="ms-2 fw-bold">Añadir</span>';
            $tooltip =  __('cycle.create_cycle');
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
                    $tooltip = __('cycle.see_data_module');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />
                    @php
                    $route = route('admin.cycles.edit', $cycle);
                    $type = "edit";
                    $text = '<i class="fa-solid fa-pen"></i>';
                    $tooltip = __('cycle.edit_data_module');
                    @endphp
                    <x-buttons.generic :route="$route" :type="$type" :text="$text" :tooltip="$tooltip" />

                    <!-- Para generar un modal diferente siempre, se debe incluir el id -->
                    @php
                    $id_modal = '#modal_delete' . $cycle->id;
                    $text = '<i class="fa-solid fa-trash-can"></i>';
                    $tooltip =  __('cycle.delete_module');
                    @endphp
                    <x-buttons.open-modal :id="$id_modal" :text="$text" :type="'danger'" :tooltip="$tooltip" />
                </td>
            </tr>
            <!-- Modal para eliminar un ciclo -->
            <div class="modal fade" id="modal_delete{{$cycle->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">{{__('cycle.confirm_deletes')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del Modal -->
                        <div class="modal-body">
                        {{__('module.confirm_1')}}<b>{{ $cycle->name }}</b>? {{__('cycle.confirm_2')}}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('module.cancel')}}</button>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('admin.cycles.destroy', $cycle->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"> {{__('cycle.delete')}} </button>
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
        {!! $cycles->links('vendor.pagination.bootstrap-5') !!}
    </div>
</div>
@endsection