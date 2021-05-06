@extends('site.layouts.master')


@section('title')
    سبدخرید
@endsection

@if(isset($message))
  {!! $message !!}
@endif

@section('content')
@if (\Session::has('update-success'))
<script>alert('بروزرسانی موفق!')</script>
@endif
@if (\Session::has('update-unsuccess'))
<script>alert('بروزرسانی ناموفق!')</script>
@endif

<?php $totalprice = 0 ?>

<div class="row">
  <!--Middle Part Start-->
  <div id="content" class="col-sm-12">
    <h1 class="title">سبد خرید</h1>
    <div class="table-responsive">
      @if ( sizeof($cart_products) == 0)
      <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>سبد خرید خالی است!</strong>
      </div>
      @else
      <table class="table table-bordered">
        <thead>
          <tr>
            <td class="text-center">ردیف</td>
            <td class="text-center">تصویر</td>
            <td class="text-left">نام محصول</td>
            <td class="text-left">برند</td>
            <td class="text-left">رنگ</td>
            <td class="text-left">تعداد</td>
            <td class="text-right">قیمت واحد</td>
            <td class="text-right">کل</td>
          </tr>
        </thead>
        <tbody>
          <?php $counter = 1; ?>
          @foreach ($cart_products as $cart_product)
          <tr>
            <td class="text-center ">{{ $counter++ }}</td>
            <td class="text-center">
              <a href="{{ '/product/'.$cart_product->slug }}"><img src="{{ url('uploads/images/indexes/'.$cart_product->image) }}" alt="{{ $cart_product->title }}" title="{{ $cart_product->title }}" class="img-thumbnail" style="width: 50px" />
              </a>
            </td>
            <td class="text-left">
              <a href="{{ '/product/'.$cart_product->slug }}">{{ $cart_product->title }}</a>
            </td>
            <td class="text-left">{{ $cart_product->brand }}</td>
            <td class="text-left">{{ $cart_product->color }}</td>
            <td class="text-left">
              <form action="{{ route('cart.update' ,['id'=>$cart_product->id]) }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="input-group btn-block quantity">
                  <input type="number" name="quantity" value="{{ $cart_product->count }}" min="1" class="form-control" />
                  <span class="input-group-btn">
                    <button type="submit" data-toggle="tooltip" title="بروزرسانی" class="btn btn-primary"><i class="fa fa-refresh"></i>
                    </button>
                    <button type="button" data-toggle="tooltip" title="حذف" class="btn btn-danger" id="{{ $cart_product->id }}" onclick="del_cart_product(id)"><i class="fa fa-times-circle"></i></button>
                  </span></div>
                </form>
              </td>
              <td class="text-right">{{ $cart_product->unitprice }} تومان</td>
              <td class="text-right">{{ ($cart_product->unitprice)*($cart_product->count) }} تومان
              </td>
            </tr>
            <?php $totalprice += ($cart_product->count) * ($cart_product->unitprice); ?>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>


      <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
            <tr>
              <td class="text-right"><strong>جمع کل:</strong></td>
              <td class="text-right">{{ $totalprice }} تومان</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="buttons">
        <div class="pull-left"><a href="{{ url('/') }}" class="btn btn-default">ادامه خرید</a></div>
        <div class="pull-right"><a href="{{ url('/checkout') }}" class="btn btn-primary" @if(sizeof($cart_products) == 0) disabled @endif>تسویه حساب</a></div>
      </div>
    </div>
    <!--Middle Part End -->
  </div>

  @endsection
