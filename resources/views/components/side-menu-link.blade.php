<li class="nav-item text-small">
    <a href="{{ $route }}" class="mb-2 nav-link text-white {{ Request::is($pattern) ? 'active' : ''}}">
        <i class="{{$icon}} d-inline-block me-3"></i><span>{{$text}}</span>
    </a>
</li>