<div class="d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 280px; height: 100vh;" id="sideMenu">
    <div id="logo_div">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="{{Storage::url('public/images/vectorpaint.svg')}}" alt="logo" class="img-fluid w-100 px-4">
        </a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('/home') }}" class="fs-5 mb-2 nav-link text-white {{ Request::is('*home') ? 'active' : ''}}">
                <i class="fa-solid fa-house me-2"></i>Home
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="fs-5 mb-2 nav-link text-white {{ Request::is('*users*') ? 'active' : ''}}">
                <i class="fa-solid fa-user me-2"></i>Usuarios
            </a>
        </li>
        <li>
            <a href="{{ route('admin.roles.index') }}" class="fs-5 mb-2 nav-link text-white {{ Request::is('*roles*') ? 'active' : ''}}">
                <i class="fa-solid fa-user-gear me-2"></i>Roles
            </a>
        </li>
        <li>
            <a href="{{ route('admin.cycles.index') }}" class="fs-5 mb-2 nav-link text-white {{ Request::is('*cycles*') ? 'active' : ''}}">
                <i class="fa-solid fa-school me-2"></i>Ciclos
            </a>
        </li>
        <li>
            <a href="{{ route('admin.modules.index') }}" class="fs-5 mb-2 nav-link text-white {{ Request::is('*modules*') ? 'active' : ''}}">
                <i class="fa-solid fa-book me-2"></i>Módulos
            </a>
        </li>
        <li>
            <a href="{{ route('admin.enrollments.index') }}" class="fs-5 mb-2 nav-link text-white {{ Request::is('*enrollments*') ? 'active' : ''}}">
                <i class="fa-solid fa-graduation-cap me-2"></i>Matrículas
            </a>
        </li>
        <li>
            <a href="{{ route('admin.schedules.index') }}" class="fs-5 mb-2 nav-link text-white {{ Request::is('*schedules*') ? 'active' : ''}}">
                <i class="fa-solid fa-clock me-2"></i>Horarios
            </a>
        </li>
        <li>
            <a href="{{ route('admin.meetings.index') }}" class="fs-5 nav-link text-white {{ Request::is('*meetings*') ? 'active' : ''}}">
                <i class="fa-solid fa-handshake-simple me-2"></i>Reuniones
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ obtenerFoto(Auth::user()) }}" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{ Auth::user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
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
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                                                                                                                                                                                                                             document.getElementById('logout-form').submit();">
                    {{ __('nav.logout') }}
                </a>
            </li>
        </ul>
    </div>
</div>