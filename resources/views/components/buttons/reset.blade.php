<form action="{{ route('admin.users.reset', $user) }}" method="POST" class="d-inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Restablecer la contraseña"><i class="fa-solid fa-key"></i></button>
</form>
