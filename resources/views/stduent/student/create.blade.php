@extends('layouts.myapp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ 'Stduent Lists' }} </h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item active">{{ 'Stduent Lists' }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('stduent.stduents.store') }} method="POST" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        {{ csrf_field() }}
                        @if (\Session::get('adminerror'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('adminerror') !!}</li>
                                </ul>
                            </div>
                        @endif
                        @if (\Session::get('adminsuccess'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('adminsuccess') !!}</li>
                                </ul>
                            </div>
                        @endif
                        @if (count($categories) <= 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                        <p>Please Create Class Name First!</p>
                                    </div>
                                </div>
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
                        <h6>Stduent Photo</h6>
                        <hr>
                        <div class="media photo center">
                            <div class="media-left m-r-15">
                                <img src="{{ url('/assets/images/default-user.png') }}" id="user-photo"
                                    class="rounded-circle user-photo media-object im" alt="User"
                                    style="object-fit: fill" width="140px">
                            </div>
                            <div class="media-body">
                                <p>Upload Stduent photo.
                                    <br> <em>Image should be at least 140px x 140px</em>
                                </p>
                                <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload
                                    Photo</button>
                                <input type="file" name="logos" id="filePhoto" class="sr-only" accept="image/*"
                                    style="object-fit: fill" width="100" height="100">
                            </div>
                        </div>
                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix mb-4">

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('message.name') }}</label>
                                        <input type="text" required class="form-control" name="name" id="name"
                                            placeholder="{{ __('message.name') }}" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5 style="margin-bottom: 10px">{{ 'Select Class' }} </h5>
                                    <select class="stdclasses form-select-lg " data-style="btn-secondary"
                                        name="std_classes_id" required>
                                        <option selected value="0" class="text-black-50" disabled>--- Select Class---
                                        </option>
                                        @foreach ($categories as $event)
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
                                        <input type="tel" required class="form-control" name="rollno" id="rollno"
                                            placeholder="Enter Roll No." onkeypress="return isNumber(event);" value="{{ old('rollno') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" required class="form-control" name="email" id="email"
                                            placeholder="Enter Your Email" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="rollint"> Phone Number</label>
                                        <input type="tel" required class="form-control" name="phoneNo" id="phoneNo"
                                            placeholder="Enter Phone Number" onkeypress="return isNumber(event);" maxlength="12" min="99999999" max="99999999999" value="{{ old('phoneNo') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="Address" class="form-control" name="Address" id="Address"
                                            placeholder="Enter Your Address" value="{{ old('Address') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                @if (count($categories) <= 0)
                                    <button type="submit" class="btn btn-info" disabled="disabled"><i
                                            class="fa fa-save"></i>
                                        {{ __('message.save') }}</button>
                                @else
                                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>
                                        {{ __('message.save') }}</button>
                                @endif

                                <a href="{{ route('stduent.stduents.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{ __('message.back') }}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('assets/dist/select2/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/select2/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    {{ Session::forget('adminerror') }}
    {{ Session::forget('adminsuccess') }}
    $(document).ready(function() {
        $('.stdclasses').select2({
            closeOnSelect: true
        });
    });
</script>
