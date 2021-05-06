@extends('site.layouts.master')

@section('keywords', 'Shop, market, category')
@section('description', 'جستجوی محصولات فروشگاه')

@section('title')
    جستجو در سایت
@endsection


@section('content')
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h1 class="title">جستجو - {{ $phrase }}</h1>
            <label>شاخص جستجو</label>
            <div class="row">
                <form action="{{ url('search') }}" method="get">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Keywords"
                               value="{{ $phrase }}" name="s">
                    </div>
                    <div class="col-sm-3">
                        <select name="cat">
                            <option value="0">همه دسته ها</option>
                            @foreach ($categories as $category)
                                @if ($category->getChild->count()>0)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @foreach ($category->getChild as $submenu)
                                        <option value="{{ $submenu->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $submenu->name }}</option>
                                        @if ($submenu->getChild->count()>0)
                                            @foreach ($submenu->getChild as $submenu2)
                                                <option value="{{ $submenu2->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $submenu2->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" class="btn btn-primary" id="button-search" value="جستجو">
                    </div>

                </form>
            </div>
            <br>
            <?php
            $product_counter =0;
            foreach ($products as $product){
                $product_counter++;
            }
            ?>
            @if($product_counter == 0)
                <div class="alert alert-warning">
                    <span>نتیجه ای یافت نشد!</span>
                </div>
            @else
                <div class="product-filter">
                    <div class="row">
                        <div class="col-md-4 col-sm-5">
                            <div class="btn-group">
                                {{--<button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>--}}
                                <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row products-category">

                        @foreach($products as $product)
                            <div class="product-layout product-list col-xs-12">
                                <div class="product-thumb">
                                    <div class="image"><a href="{{ url('/product/'.$product->slug ) }}">
                                            <img src="{{ url('uploads/images/indexes/'. $product->indexImage) }}"
                                                 alt=" {{ $product->title }} " class="img-responsive" /></a></div>
                                    <div>
                                        <div class="caption">
                                            <h4><a href="{{ url('/product/'.$product->slug ) }}"> {{ $product->title }} </a></h4>
                                            <p class="description">{{ $product->description }}</p>

                                            <?php
                                            $offprice = $product->offprice;
                                            $price = $product->price;
                                            $decrease = round((($offprice-$price)/$price)*100 , 0);
                                            ?>
                                            @if ($product->offprice != 0 || $product->offprice != null)
                                                <p class="price"><span class="price-new">{{$product->offprice}}</span>
                                                    @if ($price != $offprice)
                                                        <span class="price-old">{{$product->price}}</span>
                                                        <span class="saving" dir="ltr">{{ $decrease }} %</span>
                                                    @endif
                                                </p>
                                            @else
                                                <p class="price"><span class="price-new">{{$product->price}}</span></p>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                    <div class="row">
                        <div class="col-sm-6 text-left">
                            @if (isset($products))
                                <ul class="pagination">
                                    @if ($products->currentPage() != 1)
                                        <li>
                                            <a href="{{ $products->previousPageUrl() }}">
                                                <i class="fa fa-arrow-right"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="@if ($products->currentPage()==$i)
                                                active @endif">
                                            <a href="{{ $products->url($i) }}">
                                                @if ($products->currentPage()==$i)
                                                    صفحه {{$i}} از {{$products->lastPage()}}
                                                @else
                                                    {{$i}}
                                                @endif
                                            </a>
                                        </li>
                                        @if ($i == ($products->lastPage()-1))
                                            <li><a>...</a></li>
                                        @endif
                                    @endfor
                                    @if ($products->currentPage() != $products->lastPage())
                                        <li>
                                            <a href="{{$products->nextPageUrl()}}">
                                                <i class="fa fa-arrow-left"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                        @endif

                </div>
                <!--Middle Part End -->
        </div>

@endsection