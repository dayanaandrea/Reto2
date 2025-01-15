@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Actualización del Usuario</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h4>{{ __('auth.account') }}</h4>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('auth.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                                    autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lastname"
                                class="col-md-4 col-form-label text-md-end">{{ __('auth.lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text"
                                    class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                    value="{{ old('lastname', $user->lastname) }}" required autocomplete="lastname"
                                    autofocus>

                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('auth.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

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
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
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
                                <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror"
                                    name="pin" value="{{ old('pin', $user->pin) }}" required autocomplete="pin"
                                    autofocus>

                                @error('pin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address"
                                class="col-md-4 col-form-label text-md-end">{{ __('auth.address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address', $user->address) }}" required autocomplete="address"
                                    autofocus>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone1"
                                class="col-md-4 col-form-label text-md-end">{{ __('auth.phone1') }}</label>

                            <div class="col-md-6">
                                <input id="phone1" type="text"
                                    class="form-control @error('phone1') is-invalid @enderror" name="phone1"
                                    value="{{ old('phone1', $user->phone1) }}" required autocomplete="phone1" autofocus>

                                @error('phone1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone2"
                                class="col-md-4 col-form-label text-md-end">{{ __('auth.phone2') }}</label>

                            <div class="col-md-6">
                                <input id="phone2" type="text"
                                    class="form-control @error('phone2') is-invalid @enderror" name="phone2"
                                    value="{{ old('phone2', $user->phone2) }}" autocomplete="phone2" autofocus>

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
                                    @if($user->intensive==1)
                                    <input class="form-check-input" type="checkbox" id="intensive" name="intensive" checked>
                                    @else
                                    <input class="form-check-input" type="checkbox" id="intensive" name="intensive">
                                    @endif
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