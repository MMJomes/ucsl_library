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
                    <form action={{ route('backend.book.store') }} method="POST" enctype="multipart/form-data">
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
                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="titlenumber">{{ __('message.titlenumber') }}</label>
                                        <input type="text" class="form-control" name="titlename" id="titlenumber"
                                            placeholder="{{ __('message.titlenumber') }}"
                                            value="{{ old('titlenumber') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="date">{{ __('message.date') }}</label>
                                        <input type="date" class="form-control" name="date" id="date"
                                            placeholder="{{ __('message.date') }}" value="{{ old('date') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <h5>{{ __('Select Author') }} </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="authors_id" required="true">
                                        @foreach ($authors as $event)
                                            <option value="{{ $event->id }}">
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('message.bookname') }}</label>
                                        <input type="text" class="form-control" id="name" name="bookname"
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
                                    <h5>{{ ('Select Category') }} </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="categories_id" required="true">
                                        @foreach ($categories as $event)
                                            <option value="{{ $event->id }}">
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#nameandpassword').hide();
            $('#name,#mobile,#dob').keyup(function(e) {
                var name = document.getElementById('name').value
                var mobile = document.getElementById('mobile').value
                var dob = document.getElementById('dob').value
                if (name.length > 1 && mobile.length > 1 && dob.length > 1) {
                    showauthdata(name, mobile, dob);
                }
                if (name.length == 0 || mobile.length == 0 || dob.length == 0) {
                    $('#nameandpasswords').hide();
                }
            });
        });

        function showauthdata(name, mobile, dob) {
            var usernamed = name.replace(/\s/g, '');
            var usernamefirst = usernamed.substring(0, 3);

            var usermobiles = mobile.replace(/\s/g, '');
            var usermobile = usermobiles.substr(usermobiles.length - 4);
            var userfullname = usernamefirst + usermobile;
            const [year, month, day] = dob.split('-');
            const result = [month, day, year].join('');
            var html = '';
            html += `
                                <h6>User Auth Information</h6>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input class="form-control" readonly value="${userfullname}" type="text" id="mytext">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="password">User Password</label>
                                            <input class="form-control" readonly value="${result}" type="text" id="mytextpassword">
                                        </div>
                                    </div>
                                </div>
                `;


            $('#nameandpasswords').html(html);
        }
    </script>
@endpush
