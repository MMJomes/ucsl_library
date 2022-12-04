@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Event Lists</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.event.index') }}"> Event List</a></li>
                <li class="breadcrumb-item active">Event Lists</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('backend.event.store') }} method="POST" enctype="multipart/form-data">
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
                                    <h5>Select Event Category </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="event_categories_id" required="true">
                                        @foreach ($eventCategory as $eventcategory)
                                            <option value="{{ $eventcategory->id }}">
                                                {{ $eventcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Descriptiom</label>
                                        <input type="text" class="form-control" name="descriptiom" id="descriptiom"
                                            placeholder="Descriptiom" value="{{ old('descriptiom') }}">
                                    </div>
                                </div> --}}
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Location</label>
                                        <input type="text" class="form-control" name="location" id="location"
                                            placeholder="Location" value="{{ old('location') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Map</label>
                                        <input type="text" class="form-control" name="map" id="map"
                                            placeholder="Map" value="{{ old('map') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="from_date">From Date</label>
                                        <input type="date" class="form-control" name="from_date" id="from_date"
                                            placeholder="From Date" value="{{ old('from_date') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="updatedate">To Date</label>
                                        <input type="date" class="form-control" name="to_date" id="to_date"
                                            placeholder="To Date" value="{{ old('todate') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="from_time">From Time</label>
                                        <input type="text" class="form-control" name="from_time" id="from_time"
                                            placeholder="From Time" value="{{ old('from_time') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="to_time">To Time</label>
                                        <input type="text" class="form-control" name="to_time" id="to_time"
                                            placeholder="To Time" value="{{ old('to_time') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix mb-4">
                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Status </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="status" required="true">
                                        <option value="off" selected>OFF</option>
                                        <option value="on" >ON</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Sort </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="sort" required="true">
                                        <option value="off" selected>OFF</option>
                                        <option value="on" >ON</option>
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
                                        <label for="description">Descriptiom</label>
                                        <input type="text"  class="form-control " style="maxline:2;" name="description" id="description"
                                            placeholder="Description" value="{{ old('description') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
                                <a href="{{ route('backend.event.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> Back</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
