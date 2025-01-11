<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-2 border-top">
    <!-- Texto de copyright -->
    <p class="mb-0 text-body-secondary d-block">© 2025 CIFP Elorrieta Erreka Mari LHII</p>

    <!-- Selector de idioma -->
    @include('layouts.lang-selector')

    <!-- Logo -->
    <a href="{{ route('home') }}" class="text-decoration-none d-block">
        <img src="{{ Storage::url('public/images/EEM-icono.png') }}" alt="logo" width="30">
    </a>
</footer>