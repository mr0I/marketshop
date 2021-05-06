@extends('admin.index')

@section('content')
    <form action="{{ url('admin/editProfile', ['user_id'=>Auth::user()->id] ) }}" method="post" id="editProfile"
          class="container my-4" enctype="multipart/form-data">
        {{ csrf_field() }}

        <h4>ویرایش اطلاعات کاربری</h4>
        <hr />
        <div class="form-row">
            <div class="form-group col-md-4 required">
                <label for="phone">شماره</label>
                <input type="text" class="form-control @error('phone')
                    is-invalid @enderror" id="phone" name="telephone"
                       value="{{  old('telephone') ?? Auth::user()->telephone  }}">
                @error('telephone')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="lname">نام خانوادگی</label>
                <input type="text" class="form-control @error('lname')
                    is-invalid @enderror" id="lname" name="lastname"
                       value="{{ old('lastname') ?? Auth::user()->lastname }}">
                @error('lastname')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="fname">نام</label>
                <input type="text" class="form-control @error('fname')
                    is-invalid @enderror" id="fname" name="name"
                       value="{{ old('name') ?? Auth::user()->name }}">
                @error('name')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city_list">شهر</label>
                <select id="city_list" class="form-control @error('city')
                    is-invalid @enderror" name="zone" id="city_list">
                    <option value="0" disabled selected> --- لطفا شهر انتخاب کنید --- </option>
                @foreach($cities as $city)
                        <option value="{{ $city->id }}"
                                @if(Auth::user()->zone == $city->id) selected @endif
                        >{{ $city->city }}</option>
                    @endforeach
                </select>
                @error('zone')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="state">استان</label>
                <select id="state" name="country" class="form-control @error('state')
                    is-invalid @enderror" onchange="select_state(this.value)">
                    @foreach($states as $state)
                        <option value="{{ $state->id }}"
                                @if(Auth::user()->country == $state->id) selected @endif
                        >{{ $state->city }}</option>
                    @endforeach
                </select>
                @error('country')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="new_pass2">تکرار رمز عبور جدید</label>
                <input type="password" class="form-control @error('new_pass_confirmation')
                    is-invalid @enderror"
                       id="new_pass2" name="password_confirmation">
                @error('password_confirmation')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="new_pass">رمز عبور جدید</label>
                <input type="password" class="form-control @error('new_pass')
                    is-invalid @enderror" id="new_pass" name="password">
                @error('password')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="old_pass">رمز عبور قبلی</label>
                <input type="text" class="form-control @error('old_pass')
                    is-invalid @enderror" data-userId="{{ Auth::user()->id }}" id="old_pass" name="old_pass">
                @error('old_pass')
                <small class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="profilePic">تصویر پروفایل</label>
            <input type="file" class="form-control" id="profilePic" name="profilepic" placeholder="dgd">
            @if(Auth::user()->profilepic != '')
                <img src="{{ url('uploads/images/profile_pics/'. Auth::user()->profilepic) }}"
                     alt="تصویر پروفایل" style="width: 100px;height: auto;margin: 16px;border-radius: 8px;">
            @endif
            @error('profilepic')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror

        </div>

        <div class="form-group col-md-12">
            <label>جنسیت: </label>
            <label>
                <input type="radio" value="1" class="with-gap" name="gender"
                       @if(Auth::user()->gender==1) checked @endif >
                <span>مرد</span>
            </label>
            <label>
                <input type="radio" value="2" class="with-gap" name="gender"
                       @if(Auth::user()->gender==2) checked @endif>
                <span>زن</span>
            </label>
        </div>
        <div class="form-group col-md-12">
            <input type="checkbox" class="form-control" id="newsletter" name="newsletter"
                   @if(Auth::user()->newsletter == 1) checked @endif >
            <span style="vertical-align: middle;"></span>
            <label for="newsletter" style="cursor: pointer;">عضویت در خبرنامه</label>
        </div>

        <div class="form-group">
            <input type="submit" id="editProfile_submit" class="btn btn-success pull-left"
                   value="تایید" disabled style="margin: auto 8px;">
            @if(Auth::user()->profilepic != '')
                <a class="btn btn-danger pull-left" id="{{ Auth::user()->id }}"
                   onclick="remove_profile_pic(id)" >حذف تصویر</a>
            @endif
        </div>


    </form>
@endsection