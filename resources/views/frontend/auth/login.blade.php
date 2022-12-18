@extends('layouts.auth')
@section('content')
    <style>
        body {
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

                    <form class="form-horizontal form-material" id="loginform" action="{{ route('member.login') }}"
                        method="POST">
                        @csrf
                        <div class="row justify-content-center my-auto">
                            <div class="col-md-9 col-10 my-5">
                                <div class="row justify-content-center px-3 mb-3">
                                    <img id="logo" src="{{ url('/assets/images/backlogo.jpg') }}"
                                        style="width: 30%;height: 12%;">
                                </div>
                                <h4 class="mb-1 text-center heading" style="font-family: 'Times New Roman', Times, serif">
                                    DIGITAL
                                    LIBRARY MANAGENMENT SYSTEM</h4>
                                <hr>
                                <h6 class="msg-info">Please login to your account</h6>
                                @if (\Session::get('error'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{!! \Session::get('error') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label text-muted">Name</label>
                                    <input type="text" id="name" required name="name"
                                        placeholder="Enter Your Name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label text-muted">Email</label>
                                    <input type="text" id="email" required name="email"
                                        placeholder="Enter Your Email" class="form-control">
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
<script type="text/javascript">
    {{ Session::forget('error') }}
</script>
