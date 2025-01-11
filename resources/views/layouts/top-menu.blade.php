<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="barra">
    <div class="container">
        <a class="navbar-brand m-auto" href="{{ url('/home') }}">
            <img src="{{Storage::url('public/images/logo-elorrieta.svg')}}" alt="logo" class="img-fluid"
                style="max-width: 150px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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