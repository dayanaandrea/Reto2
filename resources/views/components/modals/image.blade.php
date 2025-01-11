<!-- El id del modal debe coincidir con el atributo data-bs-target del botón, porque es para enlazarlos -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del Modal -->
            <div class="modal-header">
                <h5 class="modal-title">Cambiar la imagen de perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="modal-body">
                <!-- Formulario para cargar la nueva imagen -->
                <form action="{{ route('store-image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <div class="w-100">
                            <label for="photo" class="ps-1 mb-2 form-label text-md">Selecciona una nueva imagen de
                                perfil.</label>
                            <input id="photo" type="file" class="form-control" name="photo" autocomplete="photo"
                                accept="image/*" required>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('modals.cancel') }}</button>
                        <button type="submit" class="btn btn-danger ms-2">{{ __('modals.confirm') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>