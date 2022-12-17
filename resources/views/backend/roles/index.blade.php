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
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @canany(['role.create'])
                    <a href="{{ route('backend.roles.create') }}" class="btn btn-info btn-sm mx-2"><i class="fa fa-plus"></i>Add New Role</a>
                @endcanany
                    {{$dataTable->table(['class' => 'display nowrap table table-hover table-striped table-bordered'])}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('delete_route')
    {{ route('backend.roles.destroy', 'id') }}
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
