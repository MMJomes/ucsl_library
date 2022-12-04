@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Yue Emba Contact Lists</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.memberLists.index') }}"> Contact List</a></li>
                <li class="breadcrumb-item active">Contact Lists</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('backend.memberLists.store') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                        <p>{{ $errors->first() }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="body mt-5">
                            <h6>Basic Information</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="batch_no">Batch No</label>
                                        <input type="text" class="form-control" name="batch_no" id="batch_no"
                                            placeholder="Batch No" value="{{ old('batch_no') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Year</label>
                                        <input type="text" class="form-control" name="year" placeholder="Year"
                                            value="{{ old('year') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="roll_no">Roll No</label>
                                        <input type="text" class="form-control" name="roll_no" placeholder="Roll No"
                                            value="{{ old('roll_no') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Name" value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="date" class="form-control" name="dob" id="dob"
                                            placeholder="DOB" value="{{ old('dob') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="qualification">Qualification</label>
                                        <input type="text" class="form-control" name="qualification"
                                            placeholder="Qualification" value="{{ old('qualification') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <input type="text" class="form-control" name="occupation"
                                            placeholder="Occupation" value="{{ old('occupation') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="departement">Departement</label>
                                        <input type="text" class="form-control" name="departement"
                                            placeholder="Departement" value="{{ old('departement') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="office_phone">Office Phone</label>
                                        <input type="number" class="form-control" name="office_phone" id="office_phone"
                                            placeholder="Office Phone" value="{{ old('office_phone') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="office_address">Office Address</label>
                                        <input type="text" class="form-control" name="office_address"
                                            placeholder="Office Address" value="{{ old('office_address') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="home_phone">Home Phone</label>
                                        <input type="number" class="form-control" name="home_phone" id="home_phone"
                                            placeholder="Home Phone" value="{{ old('home_phone') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="resident">Resident</label>
                                        <input type="text" class="form-control" name="resident"
                                            placeholder="Resident" value="{{ old('resident') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="number" class="form-control" name="mobile" id="mobile"
                                            placeholder="Mobile" value="{{ old('mobile') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row clearfix mb-5">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Select Status</label> <br>
                                        <select class="form-control custom-select" name="status" id="status"
                                            placeholder="Select Status" data-placeholder="Select Status" tabindex="1">
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>

                                        </select>
                                    </div>
                                </div>
                            </div> --}}

                            <div id="nameandpasswords"></div>
                            <div id="nameandpassword">
                                <h6>User Auth Information</h6>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input class="form-control" readonly type="text" id="mytext">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="password">User Password</label>
                                            <input class="form-control" readonly type="text" id="mytextpassword">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
                                <a href="{{ route('backend.memberLists.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> Back</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#nameandpassword').hide();
            $('#name,#mobile,#dob').keyup(function(e) {
                var name = document.getElementById('name').value
                var mobile = document.getElementById('mobile').value
                var dob = document.getElementById('dob').value
                if (name.length > 1 && mobile.length > 1 && dob.length > 1) {
                    showauthdata(name, mobile, dob);
                }
                if (name.length == 0 || mobile.length == 0 || dob.length == 0) {
                    $('#nameandpasswords').hide();
                }
            });
        });

        function showauthdata(name, mobile, dob) {
            var usernamed = name.replace(/\s/g, '');
            var usernamefirst = usernamed.substring(0, 3);

            var usermobiles = mobile.replace(/\s/g, '');
            var usermobile = usermobiles.substr(usermobiles.length - 4);
            var userfullname = usernamefirst + usermobile;
            const [year, month, day] = dob.split('-');
            const result = [month, day, year].join('');
            var html = '';
            html += `
                                <h6>User Auth Information</h6>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input class="form-control" readonly value="${userfullname}" type="text" id="mytext">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="password">User Password</label>
                                            <input class="form-control" readonly value="${result}" type="text" id="mytextpassword">
                                        </div>
                                    </div>
                                </div>
                `;


            $('#nameandpasswords').html(html);
        }
    </script>
@endpush
