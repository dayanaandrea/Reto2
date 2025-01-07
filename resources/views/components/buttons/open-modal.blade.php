<a href="#" class="btn btn-{{$type}} btn-sm" data-bs-toggle="modal" data-bs-target="{{$id}}" @if($btnOpen) id="{{ $btnOpen }}" @endif data-bs-toggle="tooltip" data-bs-placement="top" title="{{$tooltip}}">
    {!! $text !!}
</a>