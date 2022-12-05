@extends('layouts.app')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Yue Emba Contact Lists</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.memberLists.index') }}"> Contact List</a></li>
                <li class="breadcrumb-item active">Edit Contact Lists</li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        @csrf
                        @method('POST')

                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="batch_no">Batch No</label>
                                        <input type="text" class="form-control" name="batch_no" id="batch_no"
                                            placeholder="Batch No" value="{{ old('batch_no', $contactListdata->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Year</label>
                                        <input type="text" class="form-control" name="year" placeholder="Year"
                                            value="{{ old('year', $contactListdata->year) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="roll_no">Roll No</label>
                                        <input type="text" class="form-control" name="roll_no" placeholder="Roll No"
                                            value="{{ old('roll_no', $contactListdata->roll_no) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ old('name', $contactListdata->name) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="text" class="form-control" name="dob" id="dob"
                                            placeholder="DOB" value="{{ old('dob', $contactListdata->dob) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="qualification">Qualification</label>
                                        <input type="text" class="form-control" name="qualification"
                                            placeholder="Qualification"
                                            value="{{ old('qualification', $contactListdata->qualification) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <input type="text" class="form-control" name="occupation"
                                            placeholder="Occupation"
                                            value="{{ old('occupation', $contactListdata->occupation) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="departement">Departement</label>
                                        <input type="text" class="form-control" name="departement"
                                            placeholder="Departement"
                                            value="{{ old('departement', $contactListdata->departement) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="office_phone">Office Phone</label>
                                        <input type="text" class="form-control" name="office_phone" id="office_phone"
                                            placeholder="Office Phone"
                                            value="{{ old('office_phone', $contactListdata->office_phone) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="office_address">Office Address</label>
                                        <input type="text" class="form-control" name="office_address"
                                            placeholder="Office Address"
                                            value="{{ old('office_address', $contactListdata->office_address) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="home_phone">Home Phone</label>
                                        <input type="text" class="form-control" name="home_phone" id="home_phone"
                                            placeholder="Home Phone"
                                            value="{{ old('home_phone', $contactListdata->home_phone) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="resident">Resident</label>
                                        <input type="text" class="form-control" name="resident"
                                            placeholder="Resident"
                                            value="{{ old('resident', $contactListdata->resident) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" name="mobile" id="mobile"
                                            placeholder="Mobile" value="{{ old('mobile', $contactListdata->mobile) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            value="{{ old('email', $contactListdata->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix mb-5">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Active Status</label> <br>

                                        <select class="form-control custom-select" disabled name="status" id="status"
                                            placeholder="Select Status" data-placeholder="Select Status" tabindex="1">
                                            <option value="1" disabled {{ $contactListdata->status == ON ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" disabled {{ $contactListdata->status == OFF ? 'selected' : '' }}>
                                                InActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <a href="{{ route('backend.memberLists.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{__('message.back')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    @endsection
