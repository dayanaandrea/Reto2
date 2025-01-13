<div class="container">
    <a class="navbar-brand m-auto" href="{{ url('/home') }}">
        <img src="{{Storage::url('public/images/logo-elorrieta.svg')}}" alt="logo" class="img-fluid"
            style="max-width: 150px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto ms-4">
            @if (Auth::user() && (Auth::user()->role->role == 'profesor'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('teachers')}}">Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('cycles')}}">Ciclos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('students')}}">Alumnos</a>
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
                <a id="navbarDropdown" class="d-flex align-items-center nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <div class="d-flex align-items-center">
                        <!-- Contenedor de la imagen de perfil -->
                        <div style="width:30px;" class="me-2">
                            <div class="rounded-image-container"
                                style="background-image: url('{{ obtenerFoto(Auth::user()) }}');">
                            </div>
                        </div>
                        <!-- Nombre del usuario -->
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </a>


                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('profile')}}">
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