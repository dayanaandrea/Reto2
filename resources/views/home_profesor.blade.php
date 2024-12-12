@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-3">Profesores</h2>
  <table class="table table-striped">
    <thead>
      <tr class="table-dark text-uppercase">
        <th scope="col">#</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <th scope="col">{{ $loop->iteration }}</th>
        <td>{{$user->apellidos}}</td>
        <td>{{$user->nombre}}</td>
        <td>{{$user->email}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection