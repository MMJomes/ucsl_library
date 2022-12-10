@extends('layouts.auth')
@section('content')
    {{-- <div class="login-register" style="background-image:url({{ asset('assets/images/CU_Loikaw.jpg') }});">
    <div class="login-box card col-6">

        <center><img src="{{ url('/assets/images/backlogo.jpg') }}" class="card-img-top" style="top: 150px !important; width: 12%; height: 12%; text-align: center">
        </center>
            <div class="card-body">
            <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}" method="POST">
                @csrf

                <h3 class="text-center m-b-20">{{ __('Login') }}</h3>
                @error('email')
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <strong>{{ __('auth.whoops') }}</strong> {{ __('auth.problem') }}
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
                        <input class="form-control form-control-danger" name="email" value="{{ old('email') }}" type="text" required="" placeholder="{{ __('Email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password"  type="password" required="" placeholder="{{ __('Password') }}">
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
                                    <a href="{{ route('password.request') }}" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i>
                                        {{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">{{ __('login') }}</button>
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
</div> --}}
    <style>
        body {
            /* color: #000;
                    overflow-x: hidden;
                    height: 100%;
                    background-image: url({{ asset('assets/images/CU_Loikaw.jpg') }});
                    object
                    background-repeat: no-repeat; */
            min-height: 100vh;
            background-color: white;
            background: url({{ asset('assets/images/CU_Loikaw.jpg') }});
            no-repeat center center;
            background-size: cover;
        }

        input,
        textarea {
            background-color: #F3E5F5;
            border-radius: 50px !important;
            padding: 12px 15px 12px 15px !important;
            width: 100%;
            box-sizing: border-box;
            border: none !important;
            border: 1px solid #F3E5F5 !important;
            font-size: 16px !important;
            color: #000 !important;
            font-weight: 400;
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #D500F9 !important;
            outline-width: 0;
            font-weight: 120;
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0;
        }

        .card {
            border-radius: 0;
            border: none;
        }

        .card1 {
            width: 50%;
        }

        .card2 {
            width: 50%;
            background-image: linear-gradient(to right, #FFD54F, #D500F9);
        }

        #logo {
            width: 10%;
            height: 10%;
        }

        .heading {
            margin-bottom: 20px !important;
        }

        ::placeholder {
            color: #000 !important;
            opacity: 1;
        }

        :-ms-input-placeholder {
            color: #000 !important;
        }

        ::-ms-input-placeholder {
            color: #000 !important;
        }

        .form-control-label {
            font-size: 12px;
            margin-left: 15px;
        }

        .msg-info {
            padding-left: 5px;
        }

        .btn-color {
            border-radius: 50px;
            color: #fff;
            background-image: linear-gradient(to right, #FFD54F, #D500F9);
            padding: 15px;
            cursor: pointer;
            border: none !important;
        }

        .btn-color:hover {
            color: #fff;
            background-image: linear-gradient(to right, #D500F9, #FFD54F);
        }

        .btn-white {
            border-radius: 50px;
            color: #D500F9;
            background-color: #fff;
            padding: 8px 40px;
            cursor: pointer;
            border: 2px solid #D500F9 !important;
        }

        .btn-white:hover {
            color: #fff;
            background-image: linear-gradient(to right, #FFD54F, #D500F9);
        }

        a {
            color: #000;
        }

        a:hover {
            color: #000;
        }

        .bottom {
            width: 100%;
            margin-top: 1px !important;
        }

        .sm-text {
            font-size: 15px;
        }

        @media screen and (max-width: 992px) {
            .card1 {
                width: 100%;
                padding: 20px 30px 10px 30px;
            }

            .card2 {
                width: 100%;
            }

            .right {
                margin-top: 100px !important;
                margin-bottom: 100px !important;
            }
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 0px !important;
            }

            .card2 {
                padding: 50px;
            }

            .right {
                margin-top: 50px !important;
                margin-bottom: 50px !important;
            }
        }
    </style>
    <div class="container px-4 py-5 mx-auto">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
                <div class="card card1">

                    <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row justify-content-center my-auto">
                            <div class="col-md-8 col-10 my-5">
                                <div class="row justify-content-center px-3 mb-3">
                                    <img id="logo" src="{{ url('/assets/images/backlogo.jpg') }}"
                                        style="width: 30%;height: 12%;">
                                </div>
                                <h4 class="mb-1 text-center heading">Library Management System</h4>
                                <hr>
                                <h6 class="msg-info">Please login to your account</h6>

                                <div class="form-group">
                                    <label class="form-control-label text-muted">Email</label>
                                    <input type="text" id="email" required name="email" placeholder="Enter Your Email"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label text-muted">Password</label>
                                    <input type="password" id="password" required name="password" placeholder="Enter Your Password"
                                        class="form-control">
                                </div>

                                <div class="row justify-content-center my-3 px-3">
                                    <button class="btn-block btn-color">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card2">
                    <div class="my-auto mx-md-5 px-md-5 right">
                        <h3 class="text-white">We are more than just a company</h3>
                        <small class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
