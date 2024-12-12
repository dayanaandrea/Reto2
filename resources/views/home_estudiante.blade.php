@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Home de estudiante</h2>
    <p>Bienvenido {{$user->nombre}} {{$user->apellidos}}</p>
</div>
@endsection
