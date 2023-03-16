@inject('request', 'Illuminate\Http\Request')
@extends('layouts.stduent')
@section('content')
    <div class="container">
        {{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action={{ route('member.profiled') }} method="POST" enctype="multipart/form-data">
                            @csrf
                            {{ csrf_field() }}
                            @if (\Session::get('success'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('success') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($errors->any())
                                        <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                            <p>{{ $errors->first() }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{ Session::get('success') }}

                            <h3 style="font-family:'Times New Roman', Times, serif, sans-serif">DIGITAL LIBRARY MANAGENMENT
                                SYSTEM</h3>
                            <h3 style="font-family: 'Times New Roman', Times, serif;color: blue;">Profile</h3>
                            <hr>
                            <div class="float-center" style="text-align: center">

                                <img id="frame" src="" style="border-radius: 50%;" class="img-fluid" />
                                <br/>
                                <br/>
                                <img id="oldimage" src="{{ url($stdemail->image ?? '/assets/images/default-user.png') }}"  width="200" height="200" style="border-radius: 50%;">
                                <br><br>
                                <input type="file" name='logos' style="margin-left: 30px" id="formFile" onchange="preview()">


                            </div>
                            <div class="body mt-5">
                                <h6>{{ __('message.basicinfo') }}</h6>
                                <hr>
                                <div class="row clearfix mb-4">

                                    <div class="col-lg-6 col-md-12" style="margin-top: 12px">
                                        <div class="form-group">
                                            <label for="name">{{ __('message.name') }}</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="{{ __('message.name') }}" value="{{ old('name',$stdemail->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <h6>{{ 'Select Class' }} </h6>
                                        <select class="form-control " data-style="btn-secondary" name="std_classes_id"
                                            required="true">
                                            @foreach ($stduentCls as $event)
                                                <option value="{{ $event->id }}" style="font-weight: bold ">
                                                    {{ $event->stduentclass }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="rollno"> Roll No.(Eg: 1)</label>
                                            <input type="tel" class="form-control" name="rollno" id="rollno"
                                                placeholder="Enter Roll No." value="{{ old('rollno',$stdemail->rollno) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter Your Email" value="{{ old('email',$stdemail->email) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="rollint"> Phone Number</label>
                                            <input type="tel" class="form-control" name="phoneNo" id="phoneNo"
                                                placeholder="Enter Phone Number" value="{{ old('phoneNo',$stdemail->phoneNo) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="Address" class="form-control" name="Address" id="Address"
                                                placeholder="Enter Your Address" value="{{ old('Address',$stdemail->Address) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                        <button type="submit" class="btn btn-info"><i
                                                class="fa fa-upload"></i>
                                            {{ __('Save') }}</button>
                                         </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('member.profiled') }} method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                        <p>{{ $errors->first() }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{ Session::get('success') }}

                        <h3 style="font-family:'Times New Roman', Times, serif, sans-serif">DIGITAL LIBRARY MANAGENMENT
                            SYSTEM</h3>
                        <h3 style="font-family: 'Times New Roman', Times, serif;color: blue;">Profile</h3>
                        <hr>
                        <div class="float-center" style="text-align: center">

                            <img id="frame" src="" style="border-radius: 50%;" class="img-fluid" />
                            <br/>
                            <br/>
                            <img id="oldimage" src="{{ url($staffemail->image ?? '/assets/images/default-user.png') }}"  width="200" height="200" style="border-radius: 50%;">
                            <br><br>
                            <input type="file" name='logos' style="margin-left: 30px" id="formFile" onchange="preview()">


                        </div>

                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix mb-4">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('message.name') }}</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="{{ __('message.name') }}"
                                            value="{{ old('name', $staffemail->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5 style="margin-bottom: 10px">{{ 'Select Class' }} </h5>
                                    <select class="stdclasses form-select-lg " data-style="btn-secondary"
                                        name="departements_id" required="true">
                                        {{-- <option selected value="0" class="text-black-50" disabled>--- Select Class---
                                        </option> --}}
                                        @foreach ($depart as $des)
                                            <option value="{{ $des->id }}" {{ $des->id == $staffemail->departements_id ? 'selected' : '' }} style="font-weight: bold ">
                                                {{ $des->stfdepartment }}

                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="rollint"> Phone Number</label>
                                        <input type="tel" class="form-control" name="phoneNo" id="phoneNo"
                                            placeholder="Enter Phone Number"
                                            value="{{ old('phoneNo', $staffemail->phoneNo) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter Your Email" value="{{ old('email', $staffemail->email) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="Address" class="form-control" name="Address" id="Address"
                                            placeholder="Enter Your Address"
                                            value="{{ old('Address', $staffemail->Address) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i>
                                    {{ ('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<script>
    function preview() {
        // document.getElementById('oldimage').hide();
        frame.src = URL.createObjectURL(event.target.files[0]);
        $('#oldimage').hide();
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        frame.src = "";
    }
</script>
<script src="{{ asset('assets/dist/select2/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/select2/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.stdclasses').select2({
            closeOnSelect: true
        });
    });
</script>
