<!-- Navbar para Móviles -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
        <!-- Contenedor flexible para alinear el botón y el logo -->
        <div class="d-flex justify-content-between w-100 align-items-center">
            <a class="navbar-brand d-flex justify-content-center w-50" href="{{ url('/home') }}">
                <img src="{{Storage::url('public/images/logo-elorrieta-white.svg')}}" alt="logo"
                    class="img-fluid w-100">
            </a>
            <!-- Botón para abrir el menú lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>

    <!-- Menú de enlaces -->
    <div class="collapse navbar-collapse mt-4 ps-4" id="navbarNav">
        <ul class="navbar-nav">
            <!-- Enlaces que van a aparecer en el navbar móvil -->
            <x-side-menu-link :route="route('admin.home')" :pattern="'*home*'" :text="'Home'" :icon="'fa-solid fa-house'" />
            <x-side-menu-link :route="route('admin.users.index')" :pattern="'*users*'" :text="'Usuarios'"
                :icon="'fa-solid fa-user'" />
            <x-side-menu-link :route="route('admin.roles.index')" :pattern="'*roles*'" :text="'Roles'" :icon="'fa-solid fa-user-gear'" />
            <x-side-menu-link :route="route('admin.cycles.index')" :pattern="'*cycles*'" :text="'Ciclos'"
                :icon="'fa-solid fa-school'" />
            <x-side-menu-link :route="route('admin.modules.index')" :pattern="'*modules*'" :text="'Módulos'"
                :icon="'fa-solid fa-book'" />
            <x-side-menu-link :route="route('admin.enrollments.index')" :pattern="'*enrollments*'" :text="'Matrículas'"
                :icon="'fa-solid fa-graduation-cap'" />
            <x-side-menu-link :route="route('admin.schedules.index')" :pattern="'*schedules*'" :text="'Horarios'"
                :icon="'fa-solid fa-clock'" />
            <x-side-menu-link :route="route('admin.meetings.index')" :pattern="'*meetings*'" :text="'Reuniones'"
                :icon="'fa-solid fa-handshake-simple'" />

            <!-- Separador -->
            <hr>

            <!-- Enlace a perfil -->
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.users.show', Auth::user()) }}">
                    Perfil
                </a>
            </li>

            <!-- Enlace a cerrar sesión -->
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('nav.logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            <li class="nav-item">
                <div class="dropdown">
                    <a class="dropdown-toggle nav-link text-white" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false" href="#">
                        Idioma
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'en']) }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'es']) }}">Español</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'eus']) }}">Euskera</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>