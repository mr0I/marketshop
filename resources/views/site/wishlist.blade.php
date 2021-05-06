@extends('site.layouts.master')

@section('keywords', 'Shop, market, category')
@section('description', 'جستجوی محصولات فروشگاه')

@section('title')
    لیست علاقه مندی ها
@endsection


@section('content')
    <!-- Breadcrumb Start-->
    <ul class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ url('wishlist') }}">لیست علاقه مندی من</a></li>
    </ul>
    <!-- Breadcrumb End-->
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h1 class="title">لیست علاقه مندی</h1>
            @if($wish_products == null)
                <div class="alert alert-warning">
                    <p>لیست خالی است!</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-center">تصویر</td>
                            <td class="text-left">نام محصول</td>
                            <td class="text-left">مدل</td>
                            <td class="text-right">موجودی</td>
                            <td class="text-right">قیمت واحد</td>
                            <td class="text-right">عملیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; ?>
                            @foreach($wish_products as $wish_product)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ '/product/'.$wish_product->slug }}">
                                            <img src="{{ url('uploads/images/indexes/'.$wish_product->indexImage) }}" alt="{{ $wish_product->title }}" style="width: 100px;"  />
                                        </a>
                                    </td>
                                    <td class="text-left"><a href="{{ '/product/'.$wish_product->slug }}">{{ $wish_product->title }}</a></td>
                                    <td class="text-left">{{ $wish_product->brand }} </td>
                                    <td class="text-right">
                                        @if($wish_product->availablity==1) موجود @else ناموجود @endif
                                    </td>
                                    <td class="text-right"><div class="price"> {{ $wish_product->offprice }} تومان </div></td>
                                    <td class="text-right">
                                        <button class="btn btn-primary addToCart" id="{{$wish_product->id}}" type="button"><i class="fa fa-shopping-cart"></i></button>
                                        <a class="btn btn-danger" onclick="delete_wishproduct(id)" id="{{$wish_product->id}}"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <input type="hidden" value="1" id="input-quantity" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <!--Middle Part End -->
    </div>


@endsection