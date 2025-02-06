<a href="#" class="dropdown-item dropdown-toggle" id="dropdownLanguage" data-bs-toggle="dropdown" aria-expanded="false">
{{ __('nav.languaje') }}
</a>
<ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownLanguage">
    <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'en']) }}">{{ __('nav.languaje_ingles') }}</a></li>
    <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'es']) }}">{{ __('nav.languaje_español') }}</a></li>
    <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'eus']) }}">{{ __('nav.languaje_euskera') }}</a></li>
</ul>