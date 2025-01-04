<form action="{{ route('admin.users.reset', $user) }}" method="POST" class="d-inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-primary btn-sm">Restablecer</button>
</form>
