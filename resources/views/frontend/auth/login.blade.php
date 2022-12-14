@extends('layouts.front')
<style>
    p {
        font-weight: bold
    }
</style>
<div class="mybackground" style="background-image: url('/assets/images/CU_Loikaw.jpg'); object-fit: fill">
    <div class="container" style="opacity: 0.9">
        <div class="row">
            <div class="col-12">
                <div class="card" style="background-color: hsl(200, 53%, 96%)">
                    <center><img src="{{ url('assets/images/logo.png') }}"
                            style="width: 5%;height: 10%;margin-right: 12px" class="card-img-top" alt="logo"> <samp
                            style="font-size: 22px;font-family: 'Times New Roman', Times, serif;font-weight: bold;color: blue">DIGITAL
                            LIBRARY MANAGENMENT SYSTEM</samp>
                    </center>
                    <div class="card-title">
                        <div class="card-body">
                            <form action={{ route('member.login') }} method="POST" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                {{ csrf_field() }}

                                @if (session()->has('success'))
                                    <p class="alert alert-success">{{ session('message') }}</p>
                                @endif
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                                @if ($errors->any())
                                    <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                        <p>{{ $errors->first() }}</p>
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                @endif

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                @if (\Session::get('error'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('error') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                {{ Session::get('error') }}
                                @if (\Session::get('withErrors'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{!! \Session::get('withErrors') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                {{ Session::get('email') }}
                                <div class="body">
                                    <h6>{{ __('Select User Type ') }}</h6>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="radioOrange" name="usertype"
                                                        value="stduent">
                                                    <label for="radioOrange">Stduent</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="radioApple" name="usertype"
                                                        value="staff">
                                                    <label for="radioApple">Staff</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>{{ __('message.basicinfo') }}</h6>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Enter Your Name" required value="{{ old('name') }}">
                                                <div class="invalid-feedback">
                                                    Name is Required.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Email</label>
                                                <input type="email" required class="form-control" name="email"
                                                    placeholder="Enter Your  Email" value="{{ old('email') }}">
                                                <div class="invalid-feedback">
                                                    Email is Required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" id="mysubmit" class="btn btn-info"><i
                                                class="fa fa-save"></i>
                                            {{ ' Login ' }}</button>
                                        <a href="{{ url('/register') }}" class="btn btn-danger"><i
                                                class="icon-logout"></i> {{ 'Register' }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@section('content')
@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
      console.log("document.ready");
      toastr.info('document.ready');
    });
     toastr['info']("lor...................................");
    @if ($errors->any())
        let msg = "{{ $errors->first() }}";
        console.log(msg);
        toastr['info'](msg);
    @endif

    @if (session('success'))
        let msg = "{{ session('success') }}";
        toastr['info'](msg);
    @endif    </script>
<script type="text/javascript">
    function isNumber(e) {
        e = e || window.event;
        var charCode = e.which ? e.which : e.keyCode;
        return /\d/.test(String.fromCharCode(charCode));
    }
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    $(function() {
        $('button[type="submit"]').prop("disabled", true);
        $('input[name="usertype"]').on('click', function() {
            var ov = $('input[name="usertype"]').val;
            console.log(ov);
            if ($(this).val() == 'stduent') {
                $('button[type="submit"]').prop("disabled", false);
                // $('#stdid').show();
                // $('#staffid').hide();
            }
            if ($(this).val() == 'staff') {
                $('button[type="submit"]').prop("disabled", false);
                // $('#staffid').show();
                // $('#stdid').hide();
            }
            if ($(this).val() == null) {
                document.getElementById("mysubmit").disabled = true
            }
        });
    });
</script>
