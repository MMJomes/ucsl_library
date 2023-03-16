@extends('layouts.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ __('message.categorylist') }}</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('message.categorylist') }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (\Session::get('admininfo'))
                    <div class="alert alert-info">
                        <ul>
                            <li>{!! \Session::get('admininfo') !!}</li>
                        </ul>
                    </div>
                @endif
                @if (\Session::get('importError'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('importError') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('backend.category.upload') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                                        <p>{{ $errors->first() }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h3><a href="{{ url('admin/category/template') }}">{{ __('message.exceldownload') }}</a>
                                    </h3>

                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="import_file" class="form-label">{{ __('message.chooseexcelfile') }}</label>
                                    <input type="file" required name="import_file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv" ID="fileSelect" runat="server">
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-upload"></i>
                                    {{ __('message.upload') }}</button>
                                <a href="{{ route('backend.category.index') }}" class="btn btn-danger"><i
                                        class="icon-logout"></i> {{ __('message.back') }}</a>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    {{ Session::forget('admininfo') }}
    {{ Session::forget('importError') }}
</script>
