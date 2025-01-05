<p class="col-sm-3 fw-bold d-inline">{{ $label }}</p>
@if($route && Auth::user()->role && (Auth::user()->role->role == 'god' || Auth::user()->role->role == 'administrador'))
<a href="{{$route}}" class="col-sm-9 d-inline">
    <p class="d-inline">{!! $value !!}</p>
</a>
@else
    <p class="col-sm-9 d-inline">{!! $value !!}</p>
@endif