{{-- @extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.auth')

@section('content')
<div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('password.update') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <div class="col-xs-12">
                        <a href="{{ route('login') }}" id="to-login" class="text-muted"><i class="ti-arrow-circle-left fa-2x"></i> </a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <h3>{{ __('Reset Password') }}</h3>
                    </div>
                </div>
                <div class="form-group @error('email') has-danger @enderror">
                    <div class="col-xs-12">
                        <input class="form-control form-control-danger mb-2" name="email" type="text" required="" value="{{ $email ?? old('email') }}" placeholder="{{ __('Email') }}">
                        @error('email')
                            <small class="form-control-feedback">{{ $errors->first('email') }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group @error('password') has-danger @enderror">
                    <div class="col-xs-12">
                        <input class="form-control form-control-danger mb-2" name="password" type="password" required="" value="{{ old('password') }}" placeholder="{{ __('Password') }}">
                        @error('password')
                            <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control mb-2" name="password_confirmation" type="password" required="" value="{{ old('password_confirmation') }}" placeholder="{{ __('Password Confirmation') }}">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ __('Reset Password') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
