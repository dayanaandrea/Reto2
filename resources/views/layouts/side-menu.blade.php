<div id="sideMenu" class="d-flex flex-column flex-shrink-0 p-3 text-white"
    style="width: 280px; height: 100vh; position: sticky; top: 0; overflow-y: auto;">
    <div id="logo_div">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="{{Storage::url('public/images/logo-elorrieta-white.svg')}}" alt="logo"
                class="img-fluid w-100 px-4">
        </a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <x-side-menu-link :route="route('admin.home')" :pattern="'*home*'" :text="'Home'" :icon="'fa-solid fa-house'" />
        <x-side-menu-link :route="route('admin.users.index')" :pattern="'*users*'" :text="'Usuarios'" :icon="'fa-solid fa-user'" />
        <x-side-menu-link :route="route('admin.roles.index')" :pattern="'*roles*'" :text="'Roles'" :icon="'fa-solid fa-user-gear'" />
        <x-side-menu-link :route="route('admin.cycles.index')" :pattern="'*cycles*'" :text="'Ciclos'" :icon="'fa-solid fa-school'" />
        <x-side-menu-link :route="route('admin.modules.index')" :pattern="'*modules*'" :text="'Módulos'"
            :icon="'fa-solid fa-book'" />
        <x-side-menu-link :route="route('admin.enrollments.index')" :pattern="'*enrollments*'" :text="'Matrículas'"
            :icon="'fa-solid fa-graduation-cap'" />
        <x-side-menu-link :route="route('admin.schedules.index')" :pattern="'*schedules*'" :text="'Horarios'"
            :icon="'fa-solid fa-clock'" />
        <x-side-menu-link :route="route('admin.meetings.index')" :pattern="'*meetings*'" :text="'Reuniones'"
            :icon="'fa-solid fa-handshake-simple'" />
    </ul>
    <hr>
    <div class="dropdown dropup">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            <img src="{{ obtenerFoto(Auth::user()) }}" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
            <li class="dropdown dropend">
                <a href="#" class="dropdown-item dropdown-toggle" id="dropdownLanguage" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Idioma
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownLanguage">
                    <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'en']) }}">English</a></li>
                    <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'es']) }}">Español</a></li>
                    <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'eus']) }}">Euskera</a></li>
                </ul>
            </li>
            <li>
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
            </li>
            <hr class="dropdown-divider">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('nav.logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>