<li class="nav-item">
    <a href="{{ $route }}" class="fs-5 mb-2 nav-link text-white {{ Request::is($pattern) ? 'active' : ''}}">
        <i class="{{$icon}} d-inline-block me-3"></i><span>{{$text}}</span>
    </a>
</li>