<!-- El id del modal debe coincidir con el aributo data-bs-target del botón, porque es para enlazarlos -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="changePassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del Modal -->
            <div class="modal-header">
                <h5 class="modal-title">Cambiar la Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="modal-body">
                <!-- Formulario de cambio de contraseña -->
                <form action="{{ $ruta }}" method="POST" id="changePassForm">
                    @csrf
                    @method('PUT')

                    <!-- Campo de Contraseña Actual -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password" name="current_password" required
                            value="{{ old('current_password', '') }}">

                        @error('current_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                            id="new_password" name="new_password" required value="{{ old('new_password', '') }}">

                        @error('new_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Confirmación de Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password"
                            class="form-control @error('new_password_confirmation') is-invalid @enderror"
                            id="new_password_confirmation" name="new_password_confirmation" required
                            value="{{ old('new_password_confirmation', '') }}">

                        @error('new_password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pie del Modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Abrir el modal si contiene errores, porque si se envía se cierra
    document.addEventListener('DOMContentLoaded', function () {
        // Campos con la clase is-invalid que se añade cuando hay errores
        const invalidFields = document.querySelectorAll('.is-invalid');

        if (invalidFields.length > 0) {
            // Forzamos el clic en el botón que abre el modal
            const openModalButton = document.getElementById('{{$btnOpen}}');
            if (openModalButton) {
                openModalButton.click();
            }
        }

        // Evitar que el modal se cierre automáticamente si hay errores
        document.getElementById('submitBtn').addEventListener('click', function (event) {
            let form = document.getElementById('changePassForm');
            event.preventDefault();
            form.requestSubmit();
        });
    });
</script>