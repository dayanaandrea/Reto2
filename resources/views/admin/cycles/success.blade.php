@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Eliminación exitosa</h4>
        <p>El ciclo <b>{{$code}}</b> ha sido eliminado correctamente.</p>
        <hr>
        <p class="mb-0">¡La acción se completó de manera satisfactoria!</p>
    </div>
</div>
@endsection