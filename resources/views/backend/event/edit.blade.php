@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Event Lists</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.event.index') }}"> Event List</a></li>
                <li class="breadcrumb-item active">Event Lists</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.event.update', [$event->slug]) }}" method="POST"
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
                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Event Category </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="event_categories_id" required="true">
                                        @foreach ($eventCategory as $eventcategory)
                                            <option value="{{ $eventcategory->id }}"
                                                {{ $eventcategory->event_categories_id == $eventcategory->id ? 'selected' : '' }}>
                                                {{ $eventcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Name" value="{{ old('name',$event->name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Location</label>
                                        <input type="text" class="form-control" name="location" id="location"
                                            placeholder="Location" value="{{ old('location',$event->location) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Map</label>
                                        <input type="text" class="form-control" name="map" id="map"
                                            placeholder="Map" value="{{ old('map',$event->map) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="from_date">From Date</label>
                                        <input type="datetime" class="form-control" name="from_date" id="from_date"
                                            placeholder="From Date" value="{{ old('from_date',$event->from_date) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="to_date">To Date</label>
                                        <input type="dateime" class="form-control" name="to_date" id="to_date"
                                            placeholder="To Date" value="{{ old('to_date',$event->to_date) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="from_time">From Time</label>
                                        <input type="text" class="form-control" name="from_time" id="from_time"
                                            placeholder="From Time" value="{{ old('from_time',$event->from_time) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="to_time">To Time</label>
                                        <input type="text" class="form-control" name="to_time" id="to_time"
                                            placeholder="To Time" value="{{ old('to_time',$event->to_time) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix mb-4">
                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Status </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="status" required="true">
                                        <option value="off" {{ $event->status == OFF ? 'selected' : '' }}>OFF</option>
                                            <option value="on" {{ $event->status == ON ? 'selected' : '' }}>ON</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Sort </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="sort" required="true">
                                        <option value="off" {{ $event->sort == OFF ? 'selected' : '' }}>OFF</option>
                                            <option value="on" {{ $event->sort == ON ? 'selected' : '' }}>ON</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="createdate">Created At</label>
                                        <input type="datetime" class="form-control" name="createdate" id="createdate"
                                            placeholder="Createde At" value="{{ old('createdate',$event->createdate) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="updatedate">Updated At</label>
                                        <input type="datetime" class="form-control" name="updatedate" id="updatedate"
                                            placeholder="Updated At" value="{{ old('updatedate',$event->updatedate) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="description">Descriptiom</label>
                                        <input type="text" class="form-control " style="maxline:2;"
                                            name="description" id="description" placeholder="Description"
                                            value="{{ old('description',$event->description) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{__('message.save')}}</button>
                                <a href="{{ route('backend.event.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{__('message.back')}}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
