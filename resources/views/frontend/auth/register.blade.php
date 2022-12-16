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
                            <form action={{ route('member.reg') }} method="POST" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                {{ csrf_field() }}
                                @if (\Session::get('error'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{!! \Session::get('error') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if (\Session::get('success'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('success') !!}</li>
                                        </ul>
                                    </div>
                                @endif
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

                                    <h6>{{ __('message.basicinfo') }}</h6>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="phone"></label>
                                                <label for="tel">Phone Number.</label>
                                                <input type="tel" min="9" maxlength="11" class="form-control"
                                                    name="phoneNo" id="phoneNo" onkeypress="return isNumber(event);"
                                                    placeholder="09xxxxxx" value="{{ old('phoneNo') }}"
                                                    pattern="/^\d{10}$/[097]{9}|[0-99]{9}|[0-96]{9}|[0-96]{11}|[095]{9}">
                                                <div class="invalid-feedback">
                                                    Phone Number is Required.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Address</label>
                                                <input type="Address" class="form-control" name="Address" id="Address"
                                                    placeholder="Enter Your Address" required
                                                    value="{{ old('Address') }}">
                                                <div class="invalid-feedback">
                                                    Address is Required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix" id="stdid" style="display: none">
                                        <div class="col-lg-6 col-md-12">
                                            <h5>{{ 'Select Class' }} </h5>
                                            <select class="selectpicker form-control"
                                                data-style="form-control btn-secondary" name="std_classes_id"
                                                required="true">
                                                {{ $categories }}
                                                @foreach ($categories as $event)
                                                    <option value="{{ $event->id }}">
                                                        {{ $event->stduentclass }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="rollno"> Roll No.(Eg: 1)</label>
                                                <input type="tel" min="9" maxlength="11" class="form-control"
                                                    name="rollno" id="rollno"
                                                    onkeypress="return isNumber(event);" placeholder="Enter Roll No."
                                                    value="{{ old('rollno') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix" id="staffid" style="display: none">
                                        <div class="col-lg-12 col-md-12">
                                            <h5>{{ 'Select Staff Department' }} </h5>
                                            <select class="selectpicker form-control"
                                                data-style="form-control btn-secondary" name="departements_id"
                                                required="true">
                                                @foreach ($dcategories as $event)
                                                    <option value="{{ $event->id }}">
                                                        {{ $event->stfdepartment }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" id="mysubmit" class="btn btn-info"><i
                                                class="fa fa-save"></i>
                                            {{ __('Register') }}</button>
                                        <a href="{{ url('/login') }}" class="btn btn-danger"><i
                                                class="icon-logout"></i> {{ __('Login') }}</a>
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
    var myerror = "{{ Session::get('error') }}";
    if (myerror)
        toastr['info']("{{ Session::get('error') }}");
    var mysuccess = "{{ Session::get('success') }}";
    if (mysuccess)
        toastr['info']("{{ Session::get('success') }}");
</script>
<script type="text/javascript">
    {{ Session::forget('error') }}
    {{ Session::forget('success') }}

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
                $('#stdid').show();
                $('#staffid').show();
                $('#staffid').hide();
            }
            if ($(this).val() == 'staff') {
                $('button[type="submit"]').prop("disabled", false);
                $('#staffid').show();
                $('#stdid').show();
                $('#stdid').hide();
            }
            if ($(this).val() == null) {
                document.getElementById("mysubmit").disabled = true
            }
        });
    });
</script>
