@extends('site.layouts.master')

@section('keywords', 'Shop, market, category')
@section('description', 'دسته بندی محصولات فروشگاه')

@section('title')
  دسته بندی ها
@endsection


@section('content')
  <!-- Breadcrumb Start-->
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
    @if (isset($subcat1) && isset($subcat2))
      <li><a href="{{url('category/'.$cat->id)}}">{{ $cat->name }}</a></li>
      <li><a href="{{url('category/'.$cat->id.'/'.$subcat1->id)}}">{{ $subcat1->name }}</a></li>
      <li>{{ $subcat2->name }}</li>
      @php $title = $subcat2->name @endphp
    @elseif(isset($subcat1))
      <li><a href="{{url('category/'.$cat->id)}}">{{ $cat->name }}</a></li>
      <li>{{ $subcat1->name }}</li>
      @php $title = $subcat1->name @endphp
    @else
      <li>{{ $cat->name }}</li>
      @php $title = $cat->name @endphp
    @endif
  </ul>
  <!-- Breadcrumb End-->
  <div class="row">
    <!--Left Part Start -->
    <aside id="column-left" class="col-sm-3 hidden-xs">
      <h3 class="subtitle">دسته ها</h3>
      <div class="box-category">
        <ul id="cat_accordion">
          @foreach ($categories as $category)
            @if ($category->getChild->count()>0)
              <li><a href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a> <span class="down"></span>
                <ul>
                  @foreach ($category->getChild as $submenu)
                    @if ($submenu->getChild->count()>0)
                      <li><a href="{{ url('category/'.$category->id.'/'.$submenu->id) }}">
                          {{ $submenu->name }}</a> <span class="down"></span>
                        <ul>
                          @foreach ($submenu->getChild as $submenu2)
                            <li><a href="{{ url('category/'.$category->id.'/'.$submenu->id.'/'.$submenu2->id) }}">
                                {{ $submenu2->name }}</a></li>
                          @endforeach
                        </ul>
                      </li>
                    @else
                      <li><a href="{{ url('category/'.$category->id.'/'.$submenu->id) }}">{{ $submenu->name }}</a></li>
                    @endif
                  @endforeach
                </ul>
            @else
              <li><a href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a>
                @endif
                @endforeach
              </li>
        </ul>
      </div>

      <h3 class="subtitle">پرفروش ها</h3>
      <div class="side-item">
        @foreach ($sellproducts as $product)
          <?php
          $offprice = $product->offprice;
          $price = $product->price;
          $decrease = round((($offprice-$price)/$price)*100 , 0);
          ?>
          <div class="product-thumb clearfix">
            <div class="image"><a href="{{ url('product/'.$product->slug) }}">
                <img src="{{ url('uploads/images/indexes/'.$product->indexImage) }}" alt="{{$product->title}}" title="{{$product->title}}" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="{{ url('product/'.$product->slug) }}">{{$product->title}}</a></h4>
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
        @endforeach
      </div>

      <h3 class="subtitle">ویژه</h3>
      <div class="side-item">
        @foreach ($specproducts as $product)
          <?php
          $offprice = $product->offprice;
          $price = $product->price;
          $decrease = round((($offprice-$price)/$price)*100 , 0);
          ?>
          <div class="product-thumb clearfix">
            <div class="image"><a href="#">
                <img src="{{ url('uploads/images/indexes/'.$product->indexImage) }}" alt=" {{$product->title}}" title=" {{$product->title}} " class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="#">{{$product->title}}</a></h4>
              @if ($product->offprice != 0 || $product->offprice != null)
                <p class="price"> <span class="price-new">{{$product->offprice}}</span>
                  @if ($price != $offprice)
                    <span class="price-old">{{$product->price}}</span>
                    <span class="saving" dir="ltr">{{ $decrease }} %</span>
                  @endif
                </p>
              @else
                <p class="price"> <span class="price-new">{{$product->price}}</span></p>
              @endif
            </div>
          </div>
        @endforeach
      </div>

    </aside>
    <!--Left Part End -->

    <!--Middle Part Start-->
    <div id="content" class="col-sm-9">
      <h1 class="title">{{ $title }}</h1>

      {{--@if(sizeof($products) == 0)--}}
      @if($products->count() == 0)
        <div class="alert alert-warning" role="alert">
          محصولی موجود نیست!
        </div>
      @else
        <div class="product-filter">
          <div class="row">
            <div class="col-md-3 col-sm-5">
              <div class="btn-group">
                <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
              </div>
            </div>
            <div class="col-sm-2 text-right">
              <label class="control-label" for="input-sort" style="font-size: 12px;">مرتب سازی :</label>
            </div>
            <div class="col-md-3 col-sm-2 text-right">
              <?php
              if (isset($subcat2)){
                $sort_catId = $subcat2->id;
              }else if(isset($subcat1)){
                $sort_catId = $subcat1->id;
              }else{
                $sort_catId = $cat->id;
              }
              if (! isset($sorting)) $sorting='offprice/ASC';
              if (! isset($pagin)) $pagin=3;
              ?>

              <select id="input-sort" class="col-sm-3" onchange="location= this.value;">
                <option value="" selected="selected" disabled>انتخاب نوع فیلتر</option>
                <option value="{{  url('sort/offprice/ASC/'.$sort_catId.'/'.$pagin) }}"
                        @if($sorting == 'offprice/ASC') selected @endif>قیمت (صعودی)</option>
                <option value="{{  url('sort/offprice/DESC/'.$sort_catId.'/'.$pagin) }}"
                        @if($sorting == 'offprice/DESC') selected @endif>قیمت (نزولی)</option>
                <option value="{{  url('sort/vote/DESC/'.$sort_catId.'/'.$pagin) }}"
                        @if($sorting == 'vote/DESC') selected @endif>امتیاز (بیشترین)</option>
                <option value="{{  url('sort/vote/ASC/'.$sort_catId.'/'.$pagin) }}"
                        @if($sorting == 'vote/ASC') selected @endif>امتیاز (کمترین)</option>
              </select>
            </div>
            <div class="col-sm-1 text-right">
              <label class="control-label" for="input-limit" style="font-size: 12px;">نمایش :</label>
            </div>
            <div class="col-sm-2 text-right">
              <select id="input-limit" onchange="location= this.value;">
                <option value="" selected="selected" disabled>تعداد آیتم</option>
                <option value="{{ url('sort/'.$sorting.'/'.$sort_catId.'/3') }}"
                        @if($pagin== 3) selected @endif>3</option>
                <option value="{{ url('sort/'.$sorting.'/'.$sort_catId.'/5') }}"
                        @if($pagin== 5) selected @endif>5</option>
                <option value="{{ url('sort/'.$sorting.'/'.$sort_catId.'/10') }}"
                        @if($pagin== 10) selected @endif>10</option>
              </select>
            </div>
          </div>
        </div>
        <br />
        <div class="row products-category">
          @foreach ($products as $product)
            <?php
            $offprice = $product->offprice;
            $price = $product->price;
            $decrease = round((($offprice-$price)/$price)*100 , 0);
            ?>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="{{ url('product/'.$product->slug) }}">
                    <img src="{{url('uploads/images/indexes/' . $product->indexImage)}}"
                         alt="{{ $product->title }}" class="img-responsive" width="150"  /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="{{ url('product/'.$product->slug) }}"> {{ $product->title }} </a></h4>
                    <p class="description">
                      {{ strip_tags(mb_strimwidth($product->description , 0 , 200 , '...')) }}</p>
                    @if ($product->offprice != 0 || $product->offprice != null)
                      <p class="price"><span class="price-new">{{ $product->offprice }} تومان</span>
                        @if ($price != $offprice)
                          <span class="price-old">{{$product->price}}</span>
                          <span class="saving" dir="ltr">{{ $decrease }} %</span>
                        @endif
                      </p>
                    @else
                      <p class="price"> <span class="price-new">{{ $product->price }} تومان</span>
                      </p>
                    @endif
                  </div>

                  <?php
                    $reviews = $review::where('product_id', $product->id)
                          ->where('confirmed', '1')->get();
                  $score = 0;
                  $count = 0;
                  foreach ($reviews as $review) {
                    $score += $review->vote;
                    $count++;
                  }
                  if ($count != 0) {
                    $vote = round($score / $count, 1);
                  } else {
                    $vote = 0;
                  }
                  ?>
                  @if($vote >0 && $vote <= 1)
                        <div class="rating" style="margin: 10px auto;">
                            <span >
                                <strong class="text-muted">{{$count}} نفر</strong>
                              <img src="{{ url('image/rating/1.png') }}"  width="200">
                            </span>
                    </div>
                  @elseif($vote >1 && $vote <= 2)
                        <div class="rating" style="margin: 10px auto;">
                            <span >
                                <strong class="text-muted">{{$count}} نفر</strong>
                              <img src="{{ url('image/rating/2.png') }}"  width="200">
                            </span>
                    </div>
                  @elseif($vote >2 && $vote <= 3)
                        <div class="rating" style="margin: 10px auto;">
                            <span >
                                <strong class="text-muted">{{$count}} نفر</strong>
                              <img src="{{ url('image/rating/3.png') }}"  width="200">
                            </span>
                    </div>
                  @elseif($vote >3 && $vote <= 4)
                    <div class="rating" style="margin: 10px auto;">
                        <span>
                        <strong class="text-muted">{{$count}} نفر</strong>
                              <img src="{{ url('image/rating/4.png') }}"  width="200">
                        </span>
                    </div>
                  @elseif($vote >4 && $vote <= 5)
                        <div class="rating" style="margin: 10px auto;">
                            <span >
                                <strong class="text-muted">{{$count}} نفر</strong>
                              <img src="{{ url('image/rating/5.png') }}"  width="150">
                            </span>
                    </div>
                  @endif

                  <div class="button-group">
                      <input type="hidden" name="quantity" value="1" id="input-quantity" />
                      <input type="hidden" name="color" value="1" id="sel_color" />
                      <button class="btn-primary addToCart" type="button" id="{{ $product->id }}"><span>افزودن به سبد</span></button>
                      <?php
                      if(Auth::check()){
                          $isFav = App\UserProducts::where('product_id', $product->id)
                              ->where('user_id', Auth::user()->id)->first();
                      }else{
                          $isFav = 0;
                      }
                      ?>
                      <div class="add-to-links">
                          @guest
                              <button type="button" disabled class="wishlist addFav"
                                      data-toggle="tooltip" title="برای اینکار باید لاگین کنید!">
                                  <i class="fa fa-heart-o"></i> <span>افزودن به علاقه مندی ها</span>
                              </button>
                          @endguest
                          @auth
                              @if (!empty($isFav))
                                  @if ($isFav->isFavorite == 1)
                                      <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="حذف از علاقه مندی ها">
                                          <i class="fa fa-heart"></i><span> حذف از علاقه مندی ها</span>
                                      </button>
                                  @else
                                      <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                                          <i class="fa fa-heart-o"></i> <span>افزودن به علاقه مندی ها</span>
                                      </button>
                                  @endif
                              @else
                                  <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                                      <i class="fa fa-heart-o"></i> <span>افزودن به علاقه مندی ها</span>
                                  </button>
                              @endif
                          @endauth

                          <button type="button" data-toggle="tooltip" id="{{ $product->id }}" class="wishlist" title="مقایسه این محصول"
                                  onClick="add_to_compare(id)"><i class="fa fa-exchange"></i>
                              <span> مقایسه این محصول</span>
                          </button>
                      </div>

                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>


        <div class="row">
          {{-- <div class="text-center">{!! $products->onEachSide(3)->links() !!}</div> --}}
          <div class="col-12 text-center">
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