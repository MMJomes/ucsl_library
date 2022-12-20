@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white"><p></p></h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}"></a>Dashboard</li>
        </ol>
    </div>
</div>
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-success"><i class="ti-book"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{$totalbook }}</h3>
                        <h5 class="text-muted m-b-0">Total Book</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->

    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{$stdTotal }}</h3>
                        <h5 class="text-muted m-b-0">Total Stduents</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{$staffTotal }}</h3>
                        <h5 class="text-muted m-b-0">Total Staffs</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-success"><i class="ti-check"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{$stdActiveTotal }}</h3>
                        <h5 class="text-muted m-b-0">Total Active Stduents</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-success"><i class="ti-check"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{$staffActiveTotal }}</h3>
                        <h5 class="text-muted m-b-0">Total Active Staffs</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-danger"><i class=" fa fa-ban"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{$stdInActiveTotal }}</h3>
                        <h5 class="text-muted m-b-0">Total InActive Stduents</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-danger"><i class=" fa fa-ban"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{$staffInActiveTotal }}</h3>
                        <h5 class="text-muted m-b-0">Total InActive Staffs</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
     <!-- Column -->
     <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-info"><i class="ti-calendar"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{ $TotalstdRent }}</h3>
                        <h5 class="text-muted m-b-0">Total Books Rent By Stduents</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-info"><i class="ti-calendar"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">{{ $TotalstaffRent }}</h3>
                        <h5 class="text-muted m-b-0">Total Books Rent By Staff</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->

</div>
@endsection
