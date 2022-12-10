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
                                    {{-- <div class="row clearfix" id="stdid" style="display: none">
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
                                                <input type="tel" min="9" maxlength="11" class="form-control" name="rollno"
                                                id="rollno" onkeypress="return isNumber(event);" required placeholder="Enter Roll No."
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
                                    </div> --}}
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
