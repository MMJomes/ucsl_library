@extends('layouts.myapp')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Side Business List</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.sidebusiness.index') }}"> Side Business List</a></li>
                <li class="breadcrumb-item active">Side Business Lists</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.sidebusiness.update', [$sidebusiness->slug]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
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
                        <h6>Business Photo</h6>
                        <hr>
                        <div class="media photo center">
                            <div class="media-left m-r-15">
                                <img src="{{ url($sidebusiness->business_image ?? '/assets/images/default-user.png')}} " id="user-photo"
                                    class="rounded-circle user-photo media-object" alt="User" width="140px">
                            </div>
                            <div class="media-body">
                                <p>Upload Business photo.
                                    <br> <em>Image should be at least 140px x 140px</em>
                                </p>
                                <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload
                                    Photo</button>
                                <input type="file" name="business_images" readonly id="filePhoto" class="sr-only" accept="image/*">
                            </div>
                        </div>
                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="batch_no">Businees Type</label>
                                        <input type="text" class="form-control" name="business_type_id"
                                            id="business_type_id" placeholder="Business Type"
                                            value="{{ old('business_type_id', $sidebusiness->business_type_id) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ old('name', $sidebusiness->name) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="keyword">Keyword</label>
                                        <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                            value="{{ old('keyword', $sidebusiness->keyword) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            placeholder="Description" value="{{ old('description', $sidebusiness->description) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="social_link">Social Link *</label>
                                        <input type="text" class="form-control" name="social_link" id="social_link"
                                            placeholder="Social Link" value="{{ old('social_link', $sidebusiness->social_link) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_pdf">Business PDF</label>
                                        <input type="text" class="form-control" name="business_pdf"
                                            placeholder="Business PDF" value="{{ old('business_pdf', $sidebusiness->business_pdf) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_reg">Business Register No.</label>
                                        <input type="text" class="form-control" name="business_reg"
                                            placeholder="Business Register No." value="{{ old('business_reg', $sidebusiness->business_reg) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_address">Business Address *</label>
                                        <input type="text" class="form-control" name="business_address"
                                            placeholder="Business Address " value="{{ old('business_address', $sidebusiness->business_address) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_phone">Business Phone</label>
                                        <input type="text" class="form-control" name="business_phone"
                                            id="business_phone" placeholder="Business Phone"
                                            value="{{ old('business_phone', $sidebusiness->business_phone) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <a href="{{ route('backend.sidebusiness.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{__('message.back')}}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
