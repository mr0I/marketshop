@extends('site.layouts.master')

@section('title')
تایید حساب کاربری
@endsection


@section('content')
<div class="container" style="margin: 50px auto;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ایمیل خود را تایید کنید') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('قبل از ادامه ، لطفاً ایمیل خود را برای پیوند تأیید بررسی کنید.') }}
                    {{ __('اگر نامه الکترونیکی را دریافت نکردید') }}, <a href="{{ route('verification.resend') }}">{{ __('برای درخواست دیگری اینجا را کلیک کنید') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
