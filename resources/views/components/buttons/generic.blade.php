@php
    switch ($type) {
        case 'edit':
            $class = 'warning';
            break;
        case 'show':
            $class = 'secondary';
            break;
        default:
            $class = 'primary';
            break;
    }
@endphp

<a href="{{$route}}" class="btn btn-{{$class}} btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tooltip}}">
    {!! $text !!}
</a>