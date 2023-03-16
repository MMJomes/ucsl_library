@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ __('message.categorylist') }}</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">
                        {{ __('message.categorylist') }}</a></li>
                <li class="breadcrumb-item active">{{ __('message.categorylist') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.category.update', ['slug' => $eventcategory->slug]) }}"
                        method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
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
                                        <label for="name">Category Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Category Name" required value="{{ old('name', $eventcategory->name) }}">

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="code">Category Code</label>
                                        <input type="tel" min="000" max="100000" class="form-control" name="code" id="name"
                                            placeholder="Enter Category Code" required value="{{ old('name', $eventcategory->code) }}">

                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="createdat">Created At</label>
                                        <input type="text" class="form-control" name="createdat" id="createdat"
                                            placeholder="Created At"
                                            value="{{ old('createdat', $eventcategory->created_at) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="updatedat">Updated At</label>
                                        <input type="text" class="form-control" name="updatedat" id="updatedat"
                                            placeholder="Updated At"
                                            value="{{ old('updatedat', $eventcategory->updated_at) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>
                                    {{ __('message.save') }}</button>
                                <a href="{{ route('backend.category.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{ __('message.back') }}</a>
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
