@extends('layouts.auth')
@section('content')
<div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material" id="loginform" action="{{ route('member.login') }}" method="POST">
                @csrf

                <h3 class="text-center m-b-20">{{ __('Member Login') }}</h3>
                @error('email')
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <strong>{{ __('whoops') }}</strong> {{ __('problem') }}
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @enderror
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control form-control-danger" name="email" value="{{ old('email') }}" type="text" required="" placeholder="{{ __('Member Email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password"  type="password" required="" placeholder="{{ __('Member Password') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                <label class="custom-control-label" for="remember">
                                    {{ __('Remember Me') }}</label>
                            </div>
                            <div class="ml-auto">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('user.password.reset') }}" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i>
                                        {{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">{{ __('Member Login') }}</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social">
                            <button class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </button>
                            <button class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus-g"></i> </button>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        {{ __('Do Not Have An Account') }} <a href="{{ route('register') }}" class="text-info m-l-5"><b> {{ __('sign up') }} </b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
