
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
            <div class="d-flex align-items-center">
                <!-- Contenedor de la imagen de perfil -->
                <div style="width:30px;" class="me-2">
                    <div class="rounded-image-container" style="background-image: url('{{ obtenerFoto(Auth::user()) }}');">
                    </div>
                </div>
                <!-- Nombre del usuario -->
                <span>{{ Auth::user()->name }}</span>
            </div>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
            <li class="dropdown dropend">
                @include('layouts.lang-selector-admin')
            </li>
            <li>
                <a class="dropdown-item" href="{{route('admin.users.show', Auth::user())}}">
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