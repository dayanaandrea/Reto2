@php
if (isset($user)){
    $name = $user->name;
    $email = $user->email;
    $lastname = $user->lastname;
    $pin = $user->pin;
    $address = $user->address;
    $phone1 = $user->phone1;
    $phone2 = $user->phone2;
    $intensive = $user->intensive;
    $role_id = $user->role_id;

    $button = __('auth.btn_create');
    $title = __('auth.title_edit');
} else {
    $name = "";
    $email = "";
    $lastname = "";
    $pin = "";
    $address = "";
    $phone1 = "";
    $phone2 = "";
    $intensive = "";
    $role_id = 0;

    $button = __('auth.btn_create');
    $title = __('auth.title_index_1');
}
@endphp

@extends('layouts.app-admin')

@section('content')
<div class="container">
    <!-- Para mostrar alertas en vez de redirigir a una página tras realizar una acción -->
    <x-alert :key="'success'" :class="'success'" />
    <x-alert :key="'error'" :class="'danger'" />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.register') }}</div>

                <div class="card-body">
                    @if($type == 'PUT')
                    <form class="mt-2" name="create_platform" action="{{ route('admin.users.update', $user) }}"
                        method="POST" enctype="multipart/form-data">

                        @method('PUT')
                        @else
                        <form class="mt-2" name="create_platform" action="{{ route('admin.users.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @method('POST')
                            @endif
                            @csrf

                            <h4>{{ __('auth.account') }}</h4>
                            <div class=" row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('auth.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus value="{{ old('name', $name) }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('auth.lastname') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $lastname) }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('auth.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $email) }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <span class="col-md-4 col-form-label text-md-end">{{ __('auth.role') }}</span>
                                <div class="col-md-6">
                                    <select name="role_id" id="role_id" class="form-select">
                                        <!-- Añadir opción sin rol -->
                                        <option value="0" {{ ((isset($user) && $user->role_id == null) || $role_id == 0) ? 'selected' : '' }}>Sin rol</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ isset($user) && ($role->id == $user->role_id) ? 'selected' : '' }}>
                                            {{ ucfirst($role->role) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <h4>{{ __('auth.info') }}</h4>


                            <div class="row mb-3">
                                <label for="pin" class="col-md-4 col-form-label text-md-end">{{ __('auth.pin') }}</label>

                                <div class="col-md-6">
                                    <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin', $pin) }}" required autocomplete="pin" autofocus>

                                    @error('pin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('auth.address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $address) }}" required autocomplete="address" autofocus>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone1" class="col-md-4 col-form-label text-md-end">{{ __('auth.phone1') }}</label>

                                <div class="col-md-6">
                                    <input id="phone1" type="text" class="form-control @error('phone1') is-invalid @enderror" name="phone1" value="{{ old('phone1', $phone1) }}" required autocomplete="phone1" autofocus>

                                    @error('phone1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone2" class="col-md-4 col-form-label text-md-end">{{ __('auth.phone2') }}</label>

                                <div class="col-md-6">
                                    <input id="phone2" type="text" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2', $phone2) }}" autocomplete="phone2" autofocus>

                                    @error('phone2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="intensive" class="col-md-4 col-form-label text-md-end">Dual intensiva</label>

                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="intensive" name="intensive" {{ $intensive == 1 ? 'checked' : '' }}>
                                    </div>

                                    @error('intensive')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('auth.submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection