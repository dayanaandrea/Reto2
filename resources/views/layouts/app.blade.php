<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Poner un enlace según el rol del usuario -->
                @if (Auth::user() && (Auth::user()->role->role == 'god' || Auth::user()->role->role == 'administrador'))
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'ElorAdmin') }}
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'ElorAdmin') }}
                    </a>
                @endif
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.enrollments.index') }}">Matriculas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.schedules.index') }}">Horarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.asignments.index') }}">Asignaciones</a>
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
                                        if (Auth::user() && (Auth::user()->role->role == 'god' || Auth::user()->role->role == 'administrador')){
                                            $perfil_ruta = route('admin.users.show', Auth::user());
                                        } else {
                                            $perfil_ruta = route('users.show', Auth::user());
                                        }
                                    @endphp
                                    <a class="dropdown-item" href="{{$perfil_ruta}}">
                                        Perfil
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>