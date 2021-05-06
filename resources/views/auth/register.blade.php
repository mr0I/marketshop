@extends('site.layouts.master')

@section('title')
ثبت نام
@endsection

@section('content')
<div class="row justify-content-center" style="margin-top: 20px">
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('register') }}">ثبت نام</a></li>
  </ul>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h1 class="title">ثبت نام حساب کاربری</h1>
        <p>اگر قبلا حساب کاربریتان را ایجاد کرد اید جهت ورود به <a href="{{ route('login') }}">صفحه ورود</a> مراجعه کنید.</p>
      </div>
      <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="regForm">
          <fieldset id="account">
            <legend>اطلاعات شخصی شما</legend>
            @csrf
            <div class="form-group row ">
              <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="reg_name" placeholder="نام*"
               name="name" value="{{ old('name') }}"  autocomplete="name" autofocus
                >
                <small class="text-danger" id="reg_name_err"></small>
                @error('name')
                <span class="invalid-feedback invalid_name" role="alert" >
                  <small>{{ $message }}</small>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row ">
              <div class="col-sm-10">
                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="reg_lname" placeholder="نام خانوادگی*"
               name="lastname" value="{{ old('lastname') }}"  autocomplete="lastname"
                >
                <small class="text-danger" id="reg_lname_err"></small>
                @error('lastname')
                <span class="invalid-feedback invalid_lname" role="alert">
                  <small>{{ $message }}</small>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row ">
              <div class="col-sm-10">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="reg_email" placeholder="آدرس ایمیل*"
                name="email" value="{{ old('email') }}"  autocomplete="email"
                >
                <small class="text-danger" id="reg_email_err1"></small>
                <small class="text-danger" id="reg_email_err2"></small>
                @error('email')
                <span class="invalid-feedback invalid_email" role="alert">
                  <small>{{ $message }}</small>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <input type="number" class="form-control @error('telephone') is-invalid @enderror"
                id="reg_phone" placeholder="شماره تلفن"  name="telephone" value="{{ old('telephone') }}" autocomplete="telephone">
                <small class="text-danger" id="reg_phone_err1"></small>
                <small class="text-danger" id="reg_phone_err2"></small>
                @error('telephone')
                <span class="invalid-feedback invalid_phone" role="alert">
                  <small>{{ $message }}</small>
                </span>
                @enderror
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>مشخصات کاربری</legend>
            <div class="form-group row ">
              <div class="col-sm-10">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="reg_username" placeholder="نام کاربری*"
                name="username" value="{{ old('username') }}"  autocomplete
                >
                <small class="text-danger" id="reg_username_err"></small>
                @error('username')
                <span class="invalid-feedback invalid_username" role="alert">
                  <small>{{ $message }}</small>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row" id="reg_pass">
              <div class="col-sm-10">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="reg_password" placeholder="رمز عبور*"
                       name="password"  autocomplete="new-password"
                >
                <button type="button" class="btn btn-default" id="reveal">
                  <i class="fa fa-eye" id="reveal_pass"></i>
                </button>
                <button type="button" class="btn btn-success" id="rand_pass">
                  رمز تصادفی
                </button>
                <div class="progress">
                  <div class="progress-bar bg-primary powerpass" role="progressbar"
                       aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <span></span>
                  </div>
                </div>
                <small class="text-danger" id="reg_password_err1"></small>
                <small class="text-danger" id="reg_password_err2"></small>
                <small class="text-danger" id="reg_password_err3"></small>
                @error('password')
                <span class="invalid-feedback invalid_password" role="alert">
                <small>{{ $message }}</small>
              </span>
                @enderror
              </div>
            </div>

          <div class="form-group row ">
            <div class="col-sm-10">
              <input type="password" class="form-control" id="reg_passwordconfirm" placeholder="تکرار رمز عبور*"
              name="password_confirmation"  autocomplete="new-password"
              >
              <small class="text-danger" id="reg_passwordconfirm_err"></small>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>آدرس</legend>
          <div class="form-group row ">
            <div class="col-sm-10">
              <select class="form-control @error('country') is-invalid @enderror" id="reg_country"
                      name="country" onchange="select_state(this.value)">
              <option value="0" disabled selected> --- لطفا استان انتخاب کنید --- </option>
                @foreach($states as $state)
                  <option value="{{  $state->id }}">{{$state->city}}</option>
                @endforeach
            </select>
              <small class="text-danger" id="reg_country_err"></small>

              @error('country')
            <span class="invalid-feedback invalid_country" role="alert">
              <small>{{ $message }}</small>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group row ">
          <div class="col-sm-10">
            <select class="form-control @error('zone') is-invalid @enderror" id="city_list" name="zone"
            >
            <option value="0" disabled selected> --- لطفا شهر انتخاب کنید --- </option>
              @if($cities != null)
                @foreach($cities as $city)
                  <option value="{{ $city->id }}">{{$city->city}}</option>
                @endforeach
              @endif
            </select>
          @error('zone')
          <span class="invalid-feedback invalid_zone" role="alert">
            <small>{{ $message }}</small>
          </span>
          @enderror
        </div>
      </div>
    </fieldset>

    <fieldset>
      <legend>خبرنامه</legend>
      <div class="form-group row">
        <label class="col-sm-2 control-label">اشتراک</label>
        <div class="col-sm-10">
          <label class="radio-inline">
            <input type="radio" value="1" name="newsletter">
            <span>بله</span>
            </label>
            <label class="radio-inline">
              <input type="radio" checked="checked" value="0" name="newsletter">
            <span>نه</span>
            </label>
            </div>
          </div>
        </fieldset>

        <div class="form-group row mb-0 mt-4">
          <div class="col-md-6 offset-md-4">
            <input type="checkbox" value="1" name="agree" id="agree" />
            <span style="vertical-align: middle;"></span>
            <label for="agree" style="cursor: pointer;font-size: 12px">
              من<a class="agree" href="#"><b>سیاست حریم خصوصی</b> </a>را خوانده ام و با آن موافق هستم</label>
            <button type="submit" class="btn btn-primary mt-4" id="reg_submit" disabled>
              ثبت نام
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
