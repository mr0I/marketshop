@extends('site.layouts.master')

@section('title')
  تسویه حساب
@endsection


@section('content')
  <!-- Breadcrumb Start-->
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('cart.index') }}">سبد خرید</a></li>
    <li>تسویه حساب</li>
  </ul>
  <!-- Breadcrumb End-->

  <div class="loadingPanel">
    <img src="{{ url('/image/progress.gif') }}" alt="" width="40" height="40">
  </div>

  <div class="row">
    <!--Middle Part Start-->
    <div id="content" class="col-sm-12">
      <h1 class="title">تسویه حساب</h1>
      <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><i class="fa fa-sign-in"></i> یک حساب کاربری ساخته و یا به حساب خود وارد شوید</h4>
            </div>
            <div class="panel-body">
              <p><label>
                  <input type="radio" class="with-gap" value="register" name="account" id="radio_reg" @if(Auth::check()) disabled @endif>
                  <span>ثبت نام حساب کاربری</span>
                </label></p>
              <p><label>
                  <input type="radio" class="with-gap" value="guest" name="account"  id="radio_guest" @if(!Auth::check()) checked @else disabled @endif >
                  <span>تسویه حساب مهمان</span>
                </label></p>
              <p><label>
                  <input type="radio" class="with-gap" value="returning" name="account" @if(Auth::check()) checked @endif  id="radio_login">
                  <span>مشتری قبلی</span>
                </label></p>
            </div>
          </div>


          <div class="panel panel-default d-none" id="panel_user">
            <div class="panel-heading d-flex flex-row align-content-around">
              <h4 class="panel-title" style="width: 50%"><i class="fa fa-user"></i> اطلاعات شخصی شما</h4>
              <a href="#" style="text-align: left;width: 50%;"><i class="fa fa-pencil text-muted"></i></a>
            </div>
            <div class="panel-body">
              @if (Auth::check())
                <fieldset>
                  <div class="form-group">
                    <label for="input-payment-username" class="control-label">نام: <strong>{{ Auth::user()->username }}</strong></label>
                  </div>
                  <div class="form-group">
                    <label for="input-payment-email" class="control-label">آدرس ایمیل: <strong>{{ Auth::user()->email }}</strong></label>
                  </div>
                  <div class="form-group">
                    <label for="input-payment-telephone" class="control-label">شماره تلفن: <strong>{{ Auth::user()->telephone }}</strong></label>
                  </div>
                  <div class="form-group">
                    <label for="input-payment-telephone" class="control-label">کشور: <strong>{{ Auth::user()->country }}</strong></label>
                  </div>
                  <div class="form-group">
                    <label for="input-payment-telephone" class="control-label">شهر: <strong>{{ Auth::user()->zone }}</strong></label>
                  </div>

                  <a class="btn btn-block" href="{{ url('/logout') }}"
                     onclick="event.preventDefault();document.getElementById('logout-form').submit()">خروج از حساب کاربری</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                    {{ csrf_field() }}
                  </form>
                </fieldset>
              @endif
            </div>
          </div>

          <div class="panel panel-default d-none" id="panel_reg">
            <div class="panel-heading">
              <h4 class="panel-title"><i class="fa fa-user-plus"></i> ثبت نام سریع </h4>
            </div>
            <div class="panel-body">
              <form action="{{ route('register') }}" method="POST">
                @csrf
                <fieldset>
                  <div class="form-group required">
                    <label for="input-payment-username" class="control-label @error('username') is-invalid @enderror">نام کاربری</label>
                    <input type="text" class="form-control" id="input-payment-username" placeholder="نام کاربری" value="" name="username">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                    @enderror
                  </div>
                  <div class="form-group required">
                    <label for="input-payment-email" class="control-label @error('email') is-invalid @enderror">آدرس ایمیل</label>
                    <input type="text" class="form-control" id="input-payment-email" placeholder="آدرس ایمیل" value="" name="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                    @enderror
                  </div>
                  <div class="form-group required">
                    <label for="input-payment-password" class="control-label @error('password') is-invalid @enderror">رمز عبور</label>
                    <input type="password" class="form-control" id="input-payment-password" placeholder="رمز عبور" value="" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                    @enderror
                  </div>
                  <div class="form-group required">
                    <label for="input-payment-password_confirmation" class="control-label">تکرار رمز عبور</label>
                    <input type="password" class="form-control" id="input-payment-password_confirmation" placeholder="رمز عبور" value="" name="password_confirmation">
                  </div>
                  <div class="form-group required">
                    <label for="input-payment-telephone" class="control-label @error('telephone') is-invalid @enderror">شماره تلفن</label>
                    <input type="text" class="form-control" id="input-payment-telephone" placeholder="شماره تلفن" value="" name="telephone">
                    @error('telephone')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                    @enderror
                  </div>

                  <input type="hidden" name="name" value="your-name">
                  <input type="hidden" name="lastname" value="your-lastname">
                  <input type="hidden" name="country" value="0">
                  <input type="hidden" name="zone" value="0">
                  <input type="hidden" name="newsletter" value="0">

                  <input type="submit" class="btn btn-block" name="" id="" value="ثبت نام">
                </fieldset>
              </form>
            </div>
          </div>

          <div class="panel panel-default d-none" id="panel_login">
            <div class="panel-heading">
              <h4 class="panel-title"><i class="fa fa-user"></i> ورود به سایت </h4>
            </div>
            <div class="panel-body">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <fieldset id="account">
                  <div class="form-group required">
                    <label for="input-payment-username" class="control-label @error('username') is-invalid @enderror">نام کاربری</label>
                    <input type="text" class="form-control" id="input-payment-username" placeholder="نام کاربری" value="" name="username">
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                    @enderror
                  </div>
                  <div class="form-group required">
                    <label for="input-payment-password" class="control-label @error('password') is-invalid @enderror">رمز عبور</label>
                    <input type="password" class="form-control" id="input-payment-password" placeholder="رمز عبور" value="" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                    @enderror
                  </div>
                  <div class="form-group required">
                    <label for="captcha" class="control-label @error('captcha') is-invalid @enderror">{{ __('کد امنیتی') }}</label>
                    <div class="capInput">
                      <input type="text" name="captcha" class="form-control">
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

                  <input type="hidden" name="redirect" value="checkout">
                  <input type="submit" class="btn btn-block" name="" value="ورود">
                </fieldset>
              </form>
            </div>
          </div>
        </div>



        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-truck"></i> شیوه ی تحویل</h4>
                </div>
                <div class="panel-body">
                  <p>لطفا یک شیوه حمل و نقل انتخاب کنید.</p>
                  <p><label>
                      <input type="radio" class="with-gap delivery_method" value="0" name="delivery_method"
                             @if($offer->sendprice == 0)  checked @endif>
                      <span>رایگان</span>
                    </label>
                  </p>
                  <p><label>
                      <input type="radio" class="with-gap delivery_method" value="1" name="delivery_method"
                             @if($offer->sendprice == 8)  checked @endif>
                      <span>هزینه ی ثابت - 8000 تومان</span>
                    </label>
                  </p>
                  <p><label>
                      <input type="radio" class="with-gap delivery_method" value="2" name="delivery_method"
                             @if($offer->sendprice == 15)  checked @endif>
                      <span>ارسال هر آیتم به صورت جداگانه - 15000 تومان</span>
                    </label>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-credit-card"></i> شیوه پرداخت</h4>
                </div>
                <div class="panel-body">
                  <p>لطفا یک شیوه پرداخت برای سفارش خود انتخاب کنید.</p>

                  <p><label>
                      <input type="radio" checked class="with-gap" value="cash_on_delivery" name="payment_methode">
                      <span>پرداخت هنگام تحویل</span>
                    </label>
                  </p>
                  <p><label>
                      <input type="radio" class="with-gap" value="bank_transfer" name="payment_methode">
                      <span>واریز به حساب</span>
                    </label>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-ticket"></i>استفاده از کوپن تخفیف</h4>
                </div>
                <div class="panel-body">
                  @if ($offer->discount != 0)
                    <span class="notApplied">
                        <label for="input-coupon" class="col-sm-3 control-label">کد تخفيف خود را وارد کنيد</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="input-coupon" disabled
                             placeholder="کد تخفيف خود را در اينجا وارد کنيد" value="" name="coupon">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" id="button-coupon" disabled>اعمال کوپن <i class=""></i></button>
                      </span>
                    </div>
                     <br>
                      <span class="text-center">
                        <small class="text-warning warn">کد تخفيف اعمال شده است!</small>
                      <a class="text-danger del_coupon" title="حذف کد تخفیف" onclick="clearCoupon()">(حذف)
                    </a>
                      </span>
                      </span>
                  @else
                    <span class="notApplied">
                        <label for="input-coupon" class="col-sm-3 control-label">کد تخفیف خود را وارد کنید</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="input-coupon" placeholder="کد تخفیف خود را در اینجا وارد کنید" value="" name="coupon">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" id="button-coupon" disabled>اعمال کوپن <i class=""></i></button>
                      </span>
                    </div>
                       <small class="text-success warn" style="display: none;">کد تخفیف اعمال شد</small>
                      <a class="text-danger del_coupon"  title="حذف کد تخفیف"
                         onclick="clearCoupon()" style="display: none;">(حذف)
                      </a>
                    </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading" style="display: flex;">
                  <h4 class="panel-title" style="width: 70%;"><i class="fa fa-shopping-cart"></i> سبد خرید</h4>
                  <span class="loading" style="width: 30%; text-align: left;display: none;">
در حال تازه سازی <i class="fa fa-gear fa-spin"></i>
                  </span>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                      <tr>
                        <td class="text-center">ردیف</td>
                        <td class="text-center">تصویر</td>
                        <td class="text-left">نام محصول</td>
                        <td class="text-left">تعداد</td>
                        <td class="text-right">قیمت واحد</td>
                        <td class="text-right">کل</td>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $counter = 1;
                      $sum=0
                      ?>
                      @foreach ($cart_products as $cart_product)
                        <tr>
                          <td class="text-center ">{{ $counter++ }}</td>
                          <td class="text-center"><a href="{{ '/product/'.$cart_product->slug }}"><img src="{{ url('uploads/images/indexes/'.$cart_product->image) }}" alt="{{ $cart_product->title }}" class="img-thumbnail" style="width: 50px;"></a></td>
                          <td class="text-left"><a href="{{ '/product/'.$cart_product->slug }}">
                              {{ $cart_product->title }}</a></td>
                          <td class="text-left">
                            <form action="{{ route('cart.update' ,['id'=>$cart_product->id]) }}" method="POST">
                              @csrf
                              {{ method_field('PATCH') }}
                              <div class="input-group btn-block quantity" style="max-width: 200px;">
                                <label for="">{{ $cart_product->count }}</label>
                              </div>
                            </form>
                          </td>
                          <td class="text-right">{{ $cart_product->unitprice }} تومان</td>
                          <td class="text-right">{{ ($cart_product->unitprice)*($cart_product->count) }} تومان</td>
                        </tr>
                        <?php
                        $sum += ($cart_product->unitprice)*($cart_product->count); ?>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <td class="text-right" colspan="5"><strong>هزینه ارسال  :</strong></td>
                        <td class="text-right" id="delivery_price">{{ $offer->sendprice }} تومان</td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="5"><strong>مالیات:</strong></td>
                        <td class="text-right">{{ $offer->tax }} تومان</td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="5"><strong>مجموع:</strong></td>
                        <td class="text-right" id="sum_price">{{ $offer->sumprice }} تومان</td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="5"><strong> تخفیف:</strong></td>
                        <td class="text-right" id="discount">{{ $offer->discount }} %</td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="5"><strong>مبلغ نهایی :</strong></td>
                        <td class="text-right" id="total_price">{{ $offer->total }} تومان</td>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <p style="text-align: left;padding: 6px;">
                <a href="{{route('cart.index')}}" class="btn btn-warning">ویرایش سبد خرید</a>
                </p>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> افزودن توضیح برای سفارش.</h4>
                </div>
                <div class="panel-body">

                  <form action="{{ route('checkout_store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $offer->id  }}">
                    <input type="hidden" name="userIp" value="{{ $offer->userIp  }}">
                    <textarea rows="4" class="form-control" id="confirm_comment" name="description"></textarea>
                    <br>
                    <label class="control-label" for="confirm_agree">
                      <input type="checkbox" value="1" class="filled-in validate required" id="confirm_agree">
                      <span><a class="agree" href="#"><b>شرایط و قوانین</b></a> را خوانده ام و با آنها موافق هستم.</span>
                    </label>
                    <div class="buttons">
                      <div class="pull-right">
                        <input type="submit" class="btn btn-primary" id="button-confirm" value="تایید سفارش" disabled >
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Middle Part End -->
  </div>

@endsection

@section('scripts')
@endsection
