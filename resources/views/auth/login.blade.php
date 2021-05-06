@extends('site.layouts.master')

@section('title')
    ورود به سایت
@endsection


@section('content')
<div class="row justify-content-center my-5" style="margin-top: 50px">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ route('login') }}">ورود</a></li>
    </ul>
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-12">
            <h1 class="title">{{ __('حساب کاربری ورود') }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="subtitle">مشتری جدید</h2>
                    <p><strong>ثبت نام حساب کاربری</strong></p>
                    <p>با ایجاد حساب کاربری میتوانید سریعتر خرید کرده، از وضعیت خرید خود آگاه شده و تاریخچه ی سفارشات خود را مشاهده کنید.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary">ادامه</a>
                </div>
                <div class="col-md-6">
                    <h2 class="subtitle">مشتری قبلی</h2>
                    <p><strong>من از قبل مشتری شما هستم</strong></p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('نام کاربری') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('پسورد') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control
                                @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="captcha" class="col-md-4 col-form-label text-md-right">{{ __('کد امنیتی') }}</label>
                            <div class="col-md-6">
                                <div class="capInput">
                                    <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror">
                                    <button type="button" class="btn btn-secondary" id="cap">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                                @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <img src="{{ Captcha::url() }}" alt="" id="captcha">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <label class="control-label" for="remember">
                                        <input type="checkbox" class="filled-in validate" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="text-muted" style="font-size: 12px;">{{ __('مرا به خاطر بسپار') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>



                        <label class="control-label" for="confirm_agree">
                            <input type="checkbox" value="1" class="filled-in validate required" id="confirm_agree">
                        </label>



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ورود') }}
                                </button>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('رمزتان را فراموش کرده اید؟') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
