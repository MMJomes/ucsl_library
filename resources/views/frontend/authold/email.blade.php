@extends('layouts.auth')
@section('content')
<div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="col-xs-12">
                        <a href="{{ route('login') }}" id="to-login" class="text-muted"><i class="ti-arrow-circle-left fa-2x"></i> </a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <h3>{{ __('Recover Password') }}</h3>
                        <p class="text-muted"> {{ __('Enter your email address and we\'ll send you an email with instructions to reset your password.') }} </p>
                    </div>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group @error('email') has-danger @enderror">
                    <div class="col-xs-12">
                        <input class="form-control form-control-danger mb-2 @error('email') form-control-danger @enderror" name="email" type="text" required="" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                        @error('email')
                            <small class="form-control-feedback">{{ $errors->first('email') }}</small>
                        @enderror
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
