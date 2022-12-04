@extends('layouts.auth')
@section('content')
<div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('password.confirm') }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="col-xs-12">
                        <h3>{{ __('Confirm Password') }}</h3>
                        <p class="text-muted">  {{ __('Please confirm your password before continuing.') }} </p>
                    </div>
                </div>
                <div class="form-group @error('password') has-danger @enderror">
                    <div class="col-xs-12">
                        <input class="form-control form-control-danger mb-2 @error('password') form-control-danger @enderror" name="password" type="password" required="" value="{{ old('password') }}" placeholder="{{ __('Password') }}" autocomplete="current-password">
                        @error('password')
                            <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"> {{ __('Confirm Password') }}</button>
                        @if (Route::has('portal.password.request'))
                            <a class="btn btn-link" href="{{ route('portal.password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
