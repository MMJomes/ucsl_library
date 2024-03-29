@extends('layouts.app')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Admin Profile</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.admins.index') }}">Admin List</a></li>
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
                    <form action={{ route('backend.admins.update', $admin->id) }} method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h6>Profile Photo</h6>
                        <hr>
                        <div class="media photo">
                            <div class="media-left m-r-15">
                                <img src="{{ url($admin->image ?? '/assets/images/default-user.png') }}" id="user-photo"
                                    class="rounded-circle user-photo media-object" alt="User" width="140px">
                            </div>
                            <div class="media-body">
                                <p>Upload your photo.
                                    <br> <em>Image should be at least 140px x 140px</em>
                                </p>
                                <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload
                                    Photo</button>
                                <input type="file" name="image" id="filePhoto" class="sr-only" accept="image/*">
                            </div>
                        </div>

                        <div class="body">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                            value="{{ old('name', $admin->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            value="{{ old('email', $admin->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-12">
                                    <p class="text-danger">Note: If you don't want to change password, Leave blank</p>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix mb-5">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Select Roles</label> <br>
                                        <select class="form-control custom-select" name="roles[]" data-placeholder="Choose Role" tabindex="1">
                                            @foreach ($roles as $role)
                                                <option value="{{$role}}" {{$role == $adminroles ? 'selected' : ''}}>{{$role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Update</button>
                                <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i
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
