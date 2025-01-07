<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/images/EEM-icono.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <!--
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    -->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body id="elorrieta_body" class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="barra">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{Storage::url('public/images/logo-elorrieta.svg')}}" alt="logo" class="img-fluid"
                        style="max-width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if (Auth::user() && (Auth::user()->role->role == 'god' || Auth::user()->role->role == 'administrador'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.roles.index') }}">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.cycles.index') }}">Ciclos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.modules.index') }}">Modulos</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('nav.login') }}</a>
                                </li>
                            @endif
                        @else
                                                <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        <img src="{{ obtenerFoto(Auth::user()) }}" alt="usuario"
                                                            class="img-fluid rounded-circle mx-2" style="max-width: 30px; max-height: 30px;">
                                                        {{ Auth::user()->name }}
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                        @php
                                                            if (Auth::user() && (Auth::user()->role->role == 'god' || Auth::user()->role->role == 'administrador')) {
                                                                $perfil_ruta = route('admin.users.show', Auth::user());
                                                            } else {
                                                                $perfil_ruta = route('users.show', Auth::user());
                                                            }
                                                        @endphp
                                                        <a class="dropdown-item" href="{{$perfil_ruta}}">
                                                            Perfil
                                                        </a>

                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                                                                                                                                                                                     document.getElementById('logout-form').submit();">
                                                            {{ __('nav.logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

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