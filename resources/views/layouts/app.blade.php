<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body id="elorrieta_body" class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        @include('layouts.top-menu')
        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>
        <div class="container mt-auto">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-2 border-top">
                <!-- Texto de copyright -->
                <p class="mb-0 text-body-secondary d-block">© 2025 CIFP Elorrieta Erreka Mari LHII</p>

                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-decoration-none d-block">
                    <img src="{{ Storage::url('public/images/EEM-icono.png') }}" alt="logo" width="30">
                </a>
            </footer>
        </div>

    </div>
</body>

</html>