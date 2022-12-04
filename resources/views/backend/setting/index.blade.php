@extends('layouts.app')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Settings </h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Settings List</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Register Approve</h4>
                    <h6 class="card-subtitle">Register member Lists are auto approve .</h6>
                    <input type="checkbox" name="reg_approve" {{ $settings['reg_approve'] == ON ? 'checked' : '' }}
                        style="width: 40px;height: 40px;text-align: right;float: right;">
                    <span>&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Send Email</h4>
                    <h6 class="card-subtitle">Register members are send email by Admin!.</h6>
                    <div id="default-suggestions">
                        <input type="checkbox" name="sned_email" {{ $settings['sned_email'] == ON ? 'checked' : '' }}
                            style="width: 40px;height: 40px;text-align: right;float: right;">
                        <span>&nbsp;</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Signup Email</h4>
                    <h6 class="card-subtitle">Singup Email for send Email!.</h6>
                    <div id="the-basics">
                        <input class="typeahead form-control" type="text" name="signup_email"
                            placeholder="Enter Singup Email" value="{{ $settings['signup_email'] }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Member Expire Notification</h4>
                    <h6 class="card-subtitle">Notify the member expire date from it's Originzation.</h6>
                    <div id="the-basics">
                        <input class="typeahead form-control" type="number" name="member_expire_notify_date" placeholder="Enter Member Expiration date"
                         value="{{ $settings['member_expire_notify_date'] }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var setting_update_url = "{{ route('backend.settings.update') }}";
        $('input').not('input[type=file]').change(function() {
            let name = $(this).attr('name');
            console.log(name);
            if (!$(this).is(':checked')) {
                console.log("Not");
                if (name == 'reg_approve') {
                    let reg_approve = $('input[name=reg_approve]');
                }
            }
            if ($(this).is(':checked')) {
                console.log("Yes");
                if (name == 'reg_approve') {
                    let reg_approve = $('input[name=reg_approve]');
                }

            }
            let value;
            if (($(this).attr('type') == 'text') || ($(this).attr('type') == 'number')) {
                value = $(this).val();
            } else if (!$(this).is(':checked')) {
                value = !$(this).is(':checked') ? 'off' : 'on';
            } else {
                value = $(this).is(':checked') ? 'on' : 'off';
            }
            var myvalue = [value, name];
            console.log("value: " + value);
            $.ajax({
                url: setting_update_url,
                type: 'POST',
                data: {
                    _method: 'POST',
                    _token: '{{ csrf_token() }}',
                    value: myvalue
                },
                success: function(data) {
                    console.log(data);
                }
            });

        });
    </script>
@endpush
