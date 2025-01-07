@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.enrollments.store') }}" enctype="multipart/form-data">
                        @csrf

                        <h4>{{ __('auth.account') }}</h4>

                        <!-- Campo para id_estudiante -->
                        <div class="row mb-3">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">{{ __('Id estudiante') }}</label>

                            <div class="col-md-6">
                                <input id="student_id" type="text" class="form-control @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id') }}" required autocomplete="student_id" autofocus>

                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo para id_modulo -->
                        <div class="row mb-3">
                            <label for="module_id" class="col-md-4 col-form-label text-md-end">{{ __('Id módulo') }}</label>

                            <div class="col-md-6">
                                <input id="module_id" type="text" class="form-control @error('module_id') is-invalid @enderror" name="module_id" value="{{ old('module_id') }}" required autocomplete="module_id" autofocus>

                                @error('module_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo para id_ciclo -->
                        <div class="row mb-3">
                            <label for="cycle_id" class="col-md-4 col-form-label text-md-end">{{ __('Id ciclo') }}</label>

                            <div class="col-md-6">
                                <input id="cycle_id" type="number" class="form-control @error('cycle_id') is-invalid @enderror" name="cycle_id" value="{{ old('cycle_id') }}" required autocomplete="cycle_id" autofocus>

                                @error('cycle_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo para fecha -->
                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Fecha') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo para curso -->
                        <div class="row mb-3">
                            <label for="course" class="col-md-4 col-form-label text-md-end">{{ __('Curso') }}</label>

                            <div class="col-md-6">
                                <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ old('course') }}" required autocomplete="course" autofocus>

                                @error('course')
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
