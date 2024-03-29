@extends('layouts.myapp')

@section('content')
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">{{ 'Stduent Book Rent List' }} </h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
            <li class="breadcrumb-item active"><a
                    href="{{ route('stduent.bookRent.index') }}">{{ 'Stduent Book Rent List' }}</a></li>
        </ol>
    </div>
</div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('stduent.bookRent.store') }} method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ csrf_field() }}
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
                                    <h5>Select Stduent Name </h5>
                                    <select class="selectpicker form-control" disabled
                                        data-style="form-control btn-secondary" name="event_categories_id" required="true">
                                        @foreach ($stduents as $eventcategory)
                                            <option value="{{ $eventcategory->id }}"
                                                {{ $eventcategory->event_categories_id == $eventcategory->id ? 'selected' : '' }}>
                                                {{ $eventcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <h5 style="margin-bottom: 10px">{{ 'Select Book Name' }} </h5>
                                    <select class="selectpicker form-control  " disabled data-style="btn-secondary"
                                        name="books_id" required="true">
                                        {{-- <option selected value="0" class="text-black-50" disabled>--- Select Book Name
                                            ---
                                        </option> --}}
                                        @foreach ($books as $event)
                                            <option value="{{ $event->id }}"
                                                {{ $event->id == $Author->books_id ? 'selected' : '' }}
                                                style="font-weight: bold ">
                                                {{ $event->bookname }} (Edtion = {{ $event->edtion }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="startdate">Created At</label>
                                        <input type="date" class="form-control" name="startdate" id="startdate"
                                            placeholder="Enter Rent Date "
                                            value="{{ old('startdate', $Author->startdate) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" name="remark" id="remark"
                                            placeholder="Enter Remark" value="{{ old('remark', $Author->remark) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <a href="{{ route('stduent.bookRent.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{ __('message.back') }}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
