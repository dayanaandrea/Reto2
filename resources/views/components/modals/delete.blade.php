<!-- El id del modal debe coincidir con el aributo data-bs-target del botón, porque es para enlazarlos -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del Modal -->
            <div class="modal-header">
                <h5 class="modal-title">{{ __('modals.detele_title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="modal-body">
                <!-- Con las exclamaciones no se escapan los tags de HTML -->
                {!! $mensaje !!}
            </div>

            <!-- Pie del Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('modals.cancel') }}</button>
                <!-- Formulario de eliminación -->
                <form action="{{ $ruta }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">{{ __('modals.confirm') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>