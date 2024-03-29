@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ ('Staff Department ') }}</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
               <li class="breadcrumb-item"><a href="{{ route('staff.stfClass.index') }}"> {{ __('Staff Department') }}</a></li>
                <li class="breadcrumb-item active">{{ ('Staff Department') }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('staff.stfClass.store') }} method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="stduentclass">Department Name</label>
                                        <input type="text" required class="form-control" name="stfdepartment" id="stfdepartment"
                                            placeholder="Enter Department Name" value="{{ old('stfdepartment') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{__('message.save')}}</button>
                                <a href="{{ route('stduent.stdclass.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{__('message.back')}}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
