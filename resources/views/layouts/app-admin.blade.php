<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body id="elorrieta_body" class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex">
        @include('layouts.side-menu')
        <div class="d-flex flex-column flex-grow-1">
            <main class="py-4 flex-grow-1 overflow-auto" style="max-height: calc(100vh - 56px);">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>