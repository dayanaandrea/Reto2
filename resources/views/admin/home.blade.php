@extends('layouts.app-admin')

@php
$user = Auth::user();
@endphp

@section('content')
<div class="container">
    <h2>Home de admin</h2>
    <p>Bienvenido {{$user->name}} {{$user->lastname}}</p>
</div>
@endsection
