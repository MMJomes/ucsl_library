@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ ('Stduent Books Rent List') }}</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('stduent.bookRent.index') }}"> {{ __('message.authorlist') }}</a></li>
                <li class="breadcrumb-item active">{{ ('Stduent Books Rent List') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action={{ route('stduent.bookRent.update',[$author->id]) }} method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        {{csrf_field()}}
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
                        {{-- {{ $stduents}}
                        <hr>
                        {{ $author->stduents_id}} --}}
                        <div class="body mt-5">
                            <h6>{{ __('message.basicinfo') }}</h6>
                            <hr>
                            <div class="row clearfix mb-4">
                                {{-- <div class="col-lg-6 col-md-12">
                                    <h5>{{ ('Stduent Name') }} </h5>
                                    <select class="selectpicker form-control" data-style="form-control btn-secondary"
                                        name="stduents_id" required="true">
                                        {{ $stduents}}
                                        @foreach ($stduents as $event)
                                                <option value="{{ $event->id }}"
                                                    {{ $event->id == $author->stduents_id ? 'selected' : '' }}>
                                                    {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-lg-6 col-md-12">
                                    <h5 style="margin-bottom: 10px">{{ 'Select Stduent Name' }} </h5>
                                    <select class="stdclasses form-select-lg " data-style="btn-secondary"
                                        name="stduents_id" required>
                                        {{-- <option selected value="0" class="text-black-50" disabled>--- Select Stduent Name  ---
                                        </option> --}}
                                        @foreach ($stduents as $event)
                                            <option value="{{ $event->id }}" style="font-weight: bold " {{ $event->id == $author->stduents_id ? 'selected' : '' }}>
                                                {{ $event->name }} ( {{$event->stdclass->stduentclass }} - {{$event->rollno }} )
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <h5 style="margin-bottom: 10px">{{ 'Select Book Name' }} </h5>
                                    <select class="stdclasses form-select-lg " data-style="btn-secondary"
                                        name="books_id" required>
                                        {{-- <option selected value="0" class="text-black-50" disabled>--- Select Book Name  ---
                                        </option> --}}
                                        @foreach ($books as $event)
                                            <option value="{{ $event->id }}" {{ $event->id == $author->books_id ? 'selected' : '' }} style="font-weight: bold " >
                                                {{ $event->bookname }} (Edtion = {{ $event->edtion }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="startdate">Create Date</label>
                                        <input type="date" required class="form-control" name="startdate" id="startdate"
                                            placeholder="Enter Rent Date " value="{{ old('startdate',$author->startdate) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" name="remark" id="remark"
                                            placeholder="Enter Remark" value="{{ old('remark',$author->remark) }}">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{__('message.save')}}</button>
                            <a href="{{ route('stduent.bookRent.index') }}" class="btn btn-danger"><i
                                    class="icon-logout"></i> {{__('message.back')}}</a>
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


