@extends('layouts.auth')
@section('content')
<div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
    <div class="login-box card">
        <div class="card-header">{{ __('Verify Your Email Address') }}</div>
        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="form-horizontal" action="{{ route('verification.resend') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection
