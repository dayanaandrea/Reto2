@if(session($key))
<div class="alert alert-{{$class}} alert-dismissible fade show" role="alert">
    {!! session($key) !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif