@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ __('message.books') }}</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.book.index') }}"> {{ __('message.books') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('message.books') }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('backend.book.update', [$book->slug]) }} method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        {{ csrf_field() }}
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
                                    <div class="form-group">
                                        <label for="titlenumber">{{ __('message.titlenumber') }}</label>
                                        <input type="text" class="form-control" name="titlename" id="titlenumber"
                                            placeholder="{{ __('message.titlenumber') }}"
                                            value="{{ old('titlenumber',$book->titlenumber) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="date">{{ __('message.date') }}</label>
                                        <input type="date" class="form-control" name="date" id="date"
                                            placeholder="{{ __('message.date') }}" value="{{ old('date',$book->date) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Author </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="event_categories_id" required="true">
                                        @foreach ($authors as $event)
                                            <option value="{{ $event->id }}"
                                                {{ $event->events_id == $event->id ? 'selected' : '' }}>
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('message.bookname') }}</label>
                                        <input type="text" class="form-control" id="name" name="bookname"
                                            placeholder="{{ __('message.bookname') }}" value="{{ old('bookname',$book->bookname) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="dob">{{ __('message.bookpublisher') }}</label>
                                        <input type="text" class="form-control" name="publishername" id="dob"
                                            placeholder="{{ __('message.bookpublisher') }}"
                                            value="{{ old('publishername',$book->publishername) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="qualification">{{ __('message.producetime') }}</label>
                                        <input type="text" class="form-control" name="producetime"
                                            placeholder="{{ __('message.producetime') }}"
                                            value="{{ old('producetime',$book->edtion) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="produceyear">{{ __('message.produceyear') }}</label>
                                        <input type="text" class="form-control" name="produceyear"
                                            placeholder="{{ __('message.produceyear') }}"
                                            value="{{ old('produceyear',$book->produceyear) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="departement">{{ __('message.price') }}</label>
                                        <input type="text" class="form-control" name="price"
                                            placeholder="{{ __('message.price') }}" value="{{ old('price',$book->price) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-12">
                                    <h5>Select Category </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="event_categories_id" required="true">
                                        @foreach ($categories as $event)
                                            <option value="{{ $event->id }}"
                                                {{ $event->events_id == $event->id ? 'selected' : '' }}>
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5>{{ __('Select Available Reason') }} </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="availablereason" required="true">
                                        <option value="Buy" {{ $event->availablereason == 'Buy' ? 'selected' : '' }}>
                                            Buy
                                        </option>

                                        <option value="Donation" {{ $event->availablereason == 'Donation' ? 'selected' : '' }}>
                                            Donation
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class=" mt-4 row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="httpLinks">{{ __('Book PDF Link') }}</label>
                                        <input type="url" class="form-control" name="bookpdflink" id="httpLinks"
                                            placeholder="Enter Book PDF Link" value="{{ old('bookpdflink',$book->bookpdflink) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="remark">{{ __('message.remark') }}</label>
                                        <input type="text" class="form-control" name="remark" id="remark"
                                            placeholder="{{ __('message.remark') }}" value="{{ old('remark',$book->remark) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>
                                    {{ __('message.save') }}</button>
                                <a href="{{ route('backend.book.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{ __('message.back') }}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
