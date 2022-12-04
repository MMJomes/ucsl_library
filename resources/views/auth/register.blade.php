@extends('layouts.auth')
@section('content')
    <div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="registerform" action="{{ route('register') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-center">{{ __('Sign Up') }}</h3>

                    {{-- <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <input type="file" name="profile_image" class="d-none" id="profile-image"
                                accept="image/png, image/jpg, image/jpeg">
                            <label for="profile-image"
                                class="border rounded-circle cursor-pointer hover-bg-gray-100 profile-image">
                                <i class="fas fa-plus fa-2x p-4"></i>
                            </label>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="name" type="text" required=""
                                placeholder="{{ __('Name') }}" value="{{ old('name') }}">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" type="text" required=""
                                placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="password" type="password" required=""
                                placeholder="{{ __('Password') }}">
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="password_confirmation" type="password" required=""
                                placeholder="{{ __('Password Confirmation') }}">
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree_to" class="custom-control-input" id="agree_to">
                                <label class="custom-control-label" for="agree_to">{{ __('I agree to all') }} <a
                                        href="javascript:void(0)">{{ __('Terms and Conditions') }}</a></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center p-b-20">
                        <div class="col-xs-12">
                            <button
                                class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light opacity-0-4 cursor-not-allowed"
                                id="submit_btn" type="submit">{{ __('Sign Up') }}</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            {{ __('Already have an account?') }} <a href="{{ route('login') }}"
                                class="text-info m-l-5"><b>{{ __('Sign In') }}</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
