@extends('site.layouts.master')


@section('title')
    مقایسه محصولات
@endsection


@section('content')
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{ url('compare') }}">مقایسه محصولات</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-12">
                    <h1 class="title">مقایسه محصولات</h1>
                    <div class="table-responsive">
                        @if($product1 == null && $product2 == null && $product3 == null)
                            <div class="alert alert-warning">
                                <span>لیست مقایسه خالی است!</span>
                            </div>
                            @else
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td colspan="4"><strong>جزئیات محصول</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>محصولات</td>
                                    @if($product1!= null)
                                        <td><a href="{{ url('product/'.$product1->slug) }}"><strong>
                                                    {{ $product1->title }}</strong></a></td>
                                    @endif
                                    @if($product2!= null)
                                        <td><a href="{{ url('product/'.$product2->slug) }}"><strong>
                                                    {{ $product2->title }}</strong></a></td>
                                    @endif
                                    @if($product3!= null)
                                        <td><a href="{{ url('product/'.$product3->slug) }}"><strong>
                                                    {{ $product3->title }}</strong></a></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>تصویر</td>
                                    @if($product1!= null)
                                        <td class="text-center">
                                            <img class="img-thumbnail" title="{{ $product1->title }}" style="width: 100px;height: auto;"
                                                 src="{{ url('uploads/images/indexes/'. $product1->indexImage) }}">
                                        </td>
                                    @endif
                                    @if($product2!= null)
                                        <td class="text-center">
                                            <img class="img-thumbnail" title="{{ $product2->title }}" style="width: 100px;height: auto;"
                                                 src="{{ url('uploads/images/indexes/'. $product2->indexImage) }}">
                                        </td>
                                    @endif
                                    @if($product3!= null)
                                        <td class="text-center">
                                            <img class="img-thumbnail" title="{{ $product3->title }}" style="width: 100px;height: auto;"
                                                 src="{{ url('uploads/images/indexes/'. $product3->indexImage) }}">
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>قیمت</td>
                                    @if($product1!= null)
                                        <td><span class="price-old">{{ $product1->price }}</span>
                                            <span class="price-new">10{{ $product1->offprice }}</span></td>
                                    @endif
                                    @if($product2!= null)
                                        <td><span class="price-old">{{ $product2->price }}</span>
                                            <span class="price-new">10{{ $product2->offprice }}</span></td>
                                    @endif
                                    @if($product3!= null)
                                        <td><span class="price-old">{{ $product3->price }}</span>
                                            <span class="price-new">10{{ $product3->offprice }}</span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>برند</td>
                                    @if($product1!= null)
                                        <td>{{ $product1->brand }}</td>
                                    @endif
                                    @if($product2!= null)
                                        <td>{{ $product2->brand }}</td>
                                    @endif
                                    @if($product3!= null)
                                        <td>{{ $product3->brand }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>وضعیت موجودی</td>
                                    @if($product1!= null)
                                        @if($product1->availablity == 0)
                                            <td style="color: red">ناموجود</td>
                                        @endif
                                        @if($product1->availablity == 1)
                                            <td style="color: forestgreen">موجود</td>
                                        @endif
                                    @endif
                                    @if($product2!= null)
                                        @if($product2->availablity == 0)
                                            <td style="color: red">ناموجود</td>
                                        @endif
                                        @if($product2->availablity == 1)
                                            <td style="color: forestgreen">موجود</td>
                                        @endif
                                    @endif
                                    @if($product3!= null)
                                        @if($product3->availablity == 0)
                                            <td style="color: red">ناموجود</td>
                                        @endif
                                        @if($product3->availablity == 1)
                                            <td style="color: forestgreen">موجود</td>
                                        @endif
                                    @endif
                                </tr>
                                <tr>
                                    <td>رتبه</td>
                                    <?php
                                    $review_count1 = 0;
                                    $review_count2 = 0;
                                    $review_count3 = 0;
                                    if (! empty($reviews1)){
                                        foreach ($reviews1 as $review){
                                            $review_count1++;
                                        }
                                    }
                                    if (! empty($reviews2)){
                                        foreach ($reviews2 as $review){
                                            $review_count2++;
                                        }
                                    }
                                    if (! empty($reviews3)){
                                        foreach ($reviews3 as $review){
                                            $review_count3++;
                                        }
                                    }

                                    ?>
                                    @if($product1!= null)
                                        <td class="rating">
                                            امتياز کاربران: {{ $product1->vote }} از 5 <br>
                                            بر اساس {{ $review_count1 }} بررسی

                                        </td>
                                    @endif
                                    @if($product2!= null)
                                        <td class="rating">
                                            امتياز کاربران: {{ $product2->vote }} از 5 <br>
                                            بر اساس {{ $review_count2 }} بررسی

                                        </td>
                                    @endif
                                    @if($product3!= null)
                                        <td class="rating">
                                            امتياز کاربران: {{ $product3->vote }} از 5 <br>
                                            بر اساس {{ $review_count3 }} بررسی

                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>ویژگی ها</td>
                                    @if(! empty($product1))
                                        <td class="description">
                                            @if(! empty($productData1))
                                                @if($productData1->spec1!=null)
                                                    {{ $productData1->spec1 }} : <br>
                                                    {{ $productData1->desc1 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                                @if($productData1->spec2!=null)
                                                    {{ $productData1->spec2 }} : <br>
                                                    {{ $productData1->desc2 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                                @if($productData1->spec3!=null)
                                                    {{ $productData1->spec3 }} : <br>
                                                    {{ $productData1->desc3 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                            @else
                                                dgdffgd
                                            @endif
                                        </td>
                                    @endif

                                    @if(! empty($product2))
                                        <td class="description">
                                            @if(! empty($productData2))
                                                @if($productData2->spec1!=null)
                                                    {{ $productData2->spec1 }} : <br>
                                                    {{ $productData2->desc1 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                                @if($productData2->spec2!=null)
                                                    {{ $productData2->spec2 }} : <br>
                                                    {{ $productData2->desc2 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                                @if($productData2->spec3!=null)
                                                    {{ $productData2->spec3 }} : <br>
                                                    {{ $productData2->desc3 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                            @else
                                                ---
                                            @endif
                                        </td>
                                    @endif

                                    @if(! empty($product3))
                                        <td class="description">
                                            @if(! empty($productData3))
                                                @if($productData3->spec1!=null)
                                                    {{ $productData3->spec1 }} : <br>
                                                    {{ $productData3->desc1 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                                @if($productData3->spec2!=null)
                                                    {{ $productData3->spec2 }} : <br>
                                                    {{ $productData3->desc2 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                                @if($productData3->spec3!=null)
                                                    {{ $productData3->spec3 }} : <br>
                                                    {{ $productData3->desc3 }} <hr>
                                                @else
                                                    ---
                                                @endif
                                            @else
                                                ---
                                            @endif
                                        </td>
                                    @endif

                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <td><input type="hidden" value="1" id="input-quantity"></td>
                                    @if($product1 != null)
                                        <td><input type="button" id="{{ $product1->id }}" class="btn btn-primary btn-block addToCart" value="افزودن به سبد">
                                            <a class="btn btn-danger btn-block" href="{{ url('remove_compare', ['id'=>1]) }}">حذف</a></td>
                                    @endif
                                    @if($product2 != null)
                                        <td><input type="button" id="{{ $product2->id }}" class="btn btn-primary btn-block addToCart" value="افزودن به سبد">
                                            <a class="btn btn-danger btn-block" href="{{ url('remove_compare', ['id'=>2]) }}">حذف</a></td>
                                    @endif
                                    @if($product3 != null)
                                        <td><input type="button" id="{{ $product3->id }}" class="btn btn-primary btn-block addToCart" value="افزودن به سبد">
                                            <a class="btn btn-danger btn-block" href="{{ url('remove_compare', ['id'=>3]) }}">حذف</a></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>

                        @endif
                    </div>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>

@endsection