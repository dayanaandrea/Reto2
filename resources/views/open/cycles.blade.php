@extends('layouts.app')
@section('content')
@if (Auth::user()->role && Auth::user()->role->role == 'profesor')
<div class="container">
    <h2 class="mb-3">Ciclos</h2>
    <x-accordions.cycles-modules :cycles="$cycles" />
</div>
@endif
@endsection