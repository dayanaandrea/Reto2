<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa-solid fa-earth-americas d-inline-block me-2"></i> <span>{{ strtoupper(session('locale', 'en')) }}</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'en']) }}">{{ __('nav.languaje_ingles') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'es']) }}">{{ __('nav.languaje_español') }}</a></li>
        <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'eus']) }}">{{ __('nav.languaje_euskera') }}</a></li>
    </ul>
</div>