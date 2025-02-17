<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body id="elorrieta_body" class="d-flex flex-column  w-100">
    <div id="app" class="d-flex w-100">
        @include('layouts.side-menu')
        <div class="d-flex flex-column flex-grow-1">
            @include('layouts.side-menu-phone')
            <main class="p-4 flex-grow-1 overflow-auto min-vh-100">
                @yield('content')
            </main>
        </div>
        @include('layouts.theme-changer')
    </div>
</body>

</html>