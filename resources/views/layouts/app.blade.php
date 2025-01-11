<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body id="elorrieta_body" class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="barra">
            @include('layouts.top-menu')
        </nav>
        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>
        <div class="container mt-auto">
            @include('layouts.footer')
        </div>

    </div>
</body>

</html>