@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ __('message.authorlist') }}</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.author.index') }}"> {{ __('message.authorlist') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('message.authorlist') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('backend.author.store') }} method="POST" enctype="multipart/form-data">
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
                                    <h5>Select Event </h5>
                                    <select class="selectpicker form-control" disabled
                                        data-style="form-control btn-secondary" name="event_categories_id" required="true">
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
                                        <label for="name">{{ __('message.name') }}</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="{{ __('message.name') }}"
                                            value="{{ old('name', $Author->name) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="createdate">Created At</label>
                                        <input type="datetime" class="form-control" name="createdate" id="createdate"
                                            placeholder="Createde At" value="{{ old('createdate', $Author->created_at) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="updatedate">Updated At</label>
                                        <input type="datetime" class="form-control" name="updatedate" id="updatedate"
                                            placeholder="Updated At" value="{{ old('updatedate', $Author->updated_at) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <a href="{{ route('backend.author.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{ __('message.back') }}</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
