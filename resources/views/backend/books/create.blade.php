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
                    <form action={{ route('backend.book.store') }} method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @if (count($authors) <= 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                        <p>Please Create Author Name First!</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                        <p>{{ $errors->first() }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <h6>Stduent Photo</h6>
                        <hr>
                        <div class="media photo center">
                            <div class="media-left m-r-15">
                                <img src="{{ url('/assets/images/default-user.png') }}" id="user-photo"
                                    class="rounded-circle user-photo media-object im" alt="User"
                                    style="object-fit: fill" width="140px">
                            </div>
                            <div class="media-body">
                                <p>Upload Book photo.
                                </p>
                                <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload
                                    Photo</button>
                                <input type="file" name="logos" id="filePhoto" class="sr-only" accept="image/*"
                                    style="object-fit: fill" width="200" height="200">
                            </div>
                        </div> --}}
                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="image">{{ __('Book Image ') }}</label>
                                        <input type="file" class="form-control" name="logos" id="logos"
                                            placeholder="Plase Select Book Image"
                                            value="{{ old('image') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="date">{{ __('Total Of Number Book') }}</label>
                                        <input type="tel" class="form-control" required name="totalbook" id="totalbook"
                                            placeholder="{{ __('Please Enter Total Of Number Book') }}" value="{{ old('totalbook') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="titlenumber">{{ __('message.titlenumber') }}</label>
                                        <input type="tel" class="form-control" required name="titlename" id="titlenumber"
                                            placeholder="{{ __('message.titlenumber') }}"
                                            value="{{ old('titlenumber') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="date">{{ __('message.date') }}</label>
                                        <input required type="date" class="form-control" name="date" id="date"
                                            placeholder="{{ __('message.date') }}" value="{{ old('date') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <h5 style="margin-bottom: 10px">{{ 'Select Author Name' }} </h5>
                                    <select class="stdclasses form-select-lg " data-style="btn-secondary"
                                        name="authors_id" required>
                                        <option selected value="0"  class="text-black-50" disabled>--- Select Author Name ---
                                        </option>
                                        @foreach ($authors as $event)
                                            <option value="{{ $event->id }}" style="font-weight: bold ">
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('message.bookname') }}</label>
                                        <input type="text" required class="form-control" id="name" name="bookname"
                                            placeholder="{{ __('message.bookname') }}" value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="dob">{{ __('message.bookpublisher') }}</label>
                                        <input type="text" class="form-control" name="publishername" id="dob"
                                            placeholder="{{ __('message.bookpublisher') }}"
                                            value="{{ old('publishername') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="edtion">{{ __('message.producetime') }}</label>
                                        <input type="text" class="form-control" name="edtion"
                                            placeholder="{{ __('message.producetime') }}"
                                            value="{{ old('producetime') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="occupation">{{ __('message.produceyear') }}</label>
                                        <input type="text" class="form-control" name="produceyear"
                                            placeholder="{{ __('message.produceyear') }}"
                                            value="{{ old('produceyear') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="departement">{{ __('message.price') }}</label>
                                        <input type="text" class="form-control" name="price"
                                            placeholder="{{ __('message.price') }}" value="{{ old('price') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <h5 style="margin-bottom: 10px">{{ 'Select Category Name' }} </h5>
                                    <select class="stdclasses form-select-lg " data-style="btn-secondary"
                                        name="categories_id" required>
                                        <option selected value="0" class="text-black-50" disabled>--- Select Category Name ---
                                        </option>
                                        @foreach ($categories as $event)
                                            <option value="{{ $event->id }}" style="font-weight: bold ">
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5>{{ __('Select Available Reason') }} </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="availablereason" required="true">
                                        <option value="Buy">
                                            Buy
                                        </option>

                                        <option value="Donation">
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
                                            placeholder="Enter Book PDF Link" value="{{ old('bookpdflink') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="remark">{{ __('message.remark') }}</label>
                                        <input type="text" class="form-control" name="remark" id="remark"
                                            placeholder="{{ __('message.remark') }}" value="{{ old('remark') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                @if (count($authors) <= 0)
                                    <button type="submit" class="btn btn-info" disabled="disabled"><i
                                            class="fa fa-save"></i>
                                        {{ __('message.save') }}</button>
                                @else
                                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>
                                        {{ __('message.save') }}</button>
                                @endif
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

<script src="{{ asset('assets/dist/select2/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/select2/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.stdclasses').select2({
            closeOnSelect: true
        });
    });
</script>
