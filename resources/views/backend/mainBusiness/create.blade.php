@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Main Business Lists</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.mainbusiness.index') }}"> Main Business List</a></li>
                <li class="breadcrumb-item active">Main Business Lists</li>
            </ol>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('backend.biztype.store') }} method="POST" enctype="multipart/form-data">
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
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="keyword">Keyword</label>
                                        <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                            value="{{ old('keyword') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="createdat">Created At</label>
                                        <input type="date" class="form-control" name="createdat" id="createdat"
                                            placeholder="Created At" value="{{ old('createdat') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="updatedat">Updated At</label>
                                        <input type="date" class="form-control" name="updatedat" id="updatedat"
                                            placeholder="Updated At" value="{{ old('updatedat') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" name="description"
                                            placeholder="Description" value="{{ old('description') }}"
                                            style=" height: 50px;">
                                    </div>
                                </div>

                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{__('message.save')}}</button>
                                <a href="{{ route('backend.biztype.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{__('message.back')}}</a>
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
                    <form action={{ route('backend.mainbusiness.store') }} method="POST" enctype="multipart/form-data">
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
                        <h6>Business Photo</h6>
                        <hr>
                        <div class="media photo center">
                            <div class="media-left m-r-15">
                                <img src="{{ url('/assets/images/default-user.png') }}" id="user-photo"
                                    class="rounded-circle user-photo media-object" alt="User" width="140px">
                            </div>
                            <div class="media-body">
                                <p>Upload Business photo.
                                    <br> <em>Image should be at least 140px x 140px</em>
                                </p>
                                <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload
                                    Photo</button>
                                <input type="file" name="business_images" required id="filePhoto" class="sr-only"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            @if ($contactListdata)
                                <input type="hidden" name="memberid" id="memberid" value="{{ $contactListdata->id }}">
                            @endif
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    {{-- <div class="form-group">
                                        <label for="batch_no">Businees Type</label>
                                        <input type="text" class="form-control" name="business_type_id"
                                            id="business_type_id" placeholder="Business Type"
                                            value="{{ old('business_type_id') }}">
                                    </div> --}}
                                    <h5>Select Businees Type </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="business_type_id" required="true">
                                        @foreach ($businessTypes as $businessType)
                                            <option value="{{ $businessType->id }}">
                                                {{ $businessType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="keyword">Keyword</label>
                                        <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                            value="{{ old('keyword') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            placeholder="Description" value="{{ old('description') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="social_link">Social Link *</label>
                                        <input type="text" class="form-control" name="social_link" id="social_link"
                                            placeholder="Social Link" value="{{ old('social_link') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_pdf">Business PDF</label>
                                        <input type="text" class="form-control" name="business_pdf"
                                            placeholder="Business PDF" value="{{ old('business_pdf') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_reg">Business Register No.</label>
                                        <input type="text" class="form-control" name="business_reg"
                                            placeholder="Business Register No." value="{{ old('business_reg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_address">Business Address *</label>
                                        <input type="text" class="form-control" name="business_address"
                                            placeholder="Business Address " value="{{ old('business_address') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="business_phone">Business Phone</label>
                                        <input type="text" class="form-control" name="business_phone"
                                            id="business_phone" placeholder="Business Phone"
                                            value="{{ old('business_phone') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{__('message.save')}}</button>
                                <a href="{{ route('backend.memberLists.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{__('message.back')}}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
