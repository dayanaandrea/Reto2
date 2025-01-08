@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cambio de Contraseña</div>

                <div class="card-body">
                    <form action="{{ route('users.store-pass', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Campo de Contraseña Actual -->
                        <div class="row mb-3">
                            <label for="current_password" class="col-md-4 col-form-label text-md-end">Contraseña
                                Actual</label>
                            <div class="col-md-6">
                                <input type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" required
                                    value="{{ old('current_password', '') }}">

                                @error('current_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo de Nueva Contraseña -->
                        <div class="row mb-3">
                            <label for="new_password" class="col-md-4 col-form-label text-md-end">Nueva
                                Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password" required
                                    value="{{ old('new_password', '') }}">

                                @error('new_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo de Confirmación de Nueva Contraseña -->
                        <div class="row mb-3">
                            <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-end">Confirmar
                                Nueva Contraseña</label>
                            <div class="col-md-6">
                                <input type="password"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    id="new_password_confirmation" name="new_password_confirmation" required
                                    value="{{ old('new_password_confirmation', '') }}">

                                @error('new_password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
            @endsection