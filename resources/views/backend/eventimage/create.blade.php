@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Event Image Lists</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.eventimage.index') }}"> Event Image List</a></li>
                <li class="breadcrumb-item active">Event Lists</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('backend.eventimage.store') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        {{csrf_field()}}
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
                            <div class="row clearfix mb-4">
                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Event </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="events_id" required="true">
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}">
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Status </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="status" required="true">
                                        <option value="off" selected>OFF</option>
                                        <option value="on">ON</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="createdate">Created At</label>
                                        <input type="date" class="form-control" name="createdate" id="createdate"
                                            placeholder="Createde At" value="{{ old('createdate') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="updatedate">Updated At</label>
                                        <input type="date" class="form-control" name="updatedate" id="updatedate"
                                            placeholder="Updated At" value="{{ old('updatedat') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="images">Choose Event Images</label>
                                        <input type="file" class="form-control " style="maxline:2;"
                                            name="images[]" id="iamges" placeholder="Choose Event Images"
                                            value="{{ old('iamge') }}" required multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{__('message.save')}}</button>
                                <a href="{{ route('backend.eventimage.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{__('message.back')}}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
