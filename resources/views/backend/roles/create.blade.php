@extends('layouts.app')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Roles Management</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Create Roles</li>
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
                    <form action={{ route('backend.roles.store') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="role-name" class="control-label">Role Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="role-name"
                                placeholder="Name">
                        </div>

                        <div class="pb-2">
                            <h3 class="py-2">Select Permissions</h3>
                            <div class="row">
                                @foreach ($permissionGroup as $group)
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header bg-info text-white">
                                                <div class="fancy-checkbox">
                                                    <label class="mb-0">
                                                        <input type="checkbox" id="group-{{ $group->id }}"
                                                            value="{{ $group->name }}"
                                                            onclick="selectAllOrNot({{ $group->id }})">
                                                        <span>{{ $group->name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($group->permissions as $key => $permission)
                                                        <div class="col-12 col-md-6 col-lg-4 my-2">
                                                            <div class="fancy-checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="group-{{ $group->id }}"
                                                                        value="{{ $permission->name }}" name="permissions[]"
                                                                        onclick="selectItem({{ $group->id }})">
                                                                    <span>{{ $permission->name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
                            <a href="{{ route('backend.roles.index') }}" class="btn btn-danger"><i
                                    class="icon-arrow-left"></i> Back</a>
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
