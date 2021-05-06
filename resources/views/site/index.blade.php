@extends('site.layouts.master')


@section('title')
  فروشگاه مارکت شاپ
@endsection


@if (\Session::has('msg'))
  <script>alert('ثبت نام موفق')</script>
@endif


@section('content')
  <div id="content" class="col-xs-12">
    <div class="row">
      <div class="col-sm-8">
        <!-- Slideshow Start-->
        <div class="slideshow single-slider owl-carousel">
          @foreach($slides as $slide)
            <div class="item">
              <a href="{{ $slide->url }}" target="_blank">
                <img class="img-responsive"
                     src="{{ url('/uploads/images/slides/'. $slide->image) }}" alt="{{ $slide->name }}" />
              </a>
            </div>
          @endforeach
        </div>
        <!-- Slideshow End-->
      </div>
      <div class="col-sm-4 pull-right flip">
        <div class="marketshop-banner">
          <div class="row">
              @if($video != null)
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <video class="responsive-video" controls style="width:350px;height:auto;">
                          <source src="{{ url('uploads/videos/'.$video->video) }}" type="video/mp4">
                          <source src="{{ url('uploads/videos/'.$video->video) }}" type="video/webm">
                          <source src="{{ url('uploads/videos/'.$video->video) }}" type="video/ogg">
                      </video>
                  </div>
              @endif
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="#"><img title="sample-banner" alt="sample-banner" src="image/banner/sp-small-banner1-360x185.jpg"></a></div>
          </div>
        </div>
      </div>
    </div>


    <!-- پرفروش ها محصولات Start-->
    <h3 class="subtitle">پرفروش ها</h3>
    <div class="owl-carousel product_carousel my-3">
      @foreach($sellproducts as $product)
        <?php
        $offprice = $product->offprice;
        $price = $product->price;
        $decrease = round((($offprice-$price)/$price)*100 , 0);
        ?>
        <div class="product-thumb clearfix">
          <div class="image"><a href="{{ url('product/'. $product->slug) }}">
              <img src="{{ url('uploads/images/indexes/' . $product->indexImage) }}"
                   alt=" {{ $product->title }}"  class="img-responsive" /></a></div>
          <div class="caption">
            <h4><a href="{{ url('product/'. $product->slug) }}"> {{ $product->title }}</a></h4>
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

              <?php
              $reviews = App\Review::where('product_id', $product->id)
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

          </div>
          <div class="button-group">
            {{--add to cart--}}
            <input type="hidden" name="quantity" value="1" id="input-quantity" />
            <input type="hidden" name="color" value="1" id="sel_color" />
            <button class="btn-primary addToCart" type="button" id="{{ $product->id }}"><span>افزودن به سبد</span></button>
            {{--add to favs--}}
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
                  <i class="fa fa-heart-o"></i>
                </button>
              @endguest
              @auth
                @if (!empty($isFav))
                  @if ($isFav->isFavorite == 1)
                    <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="حذف از علاقه مندی ها">
                      <i class="fa fa-heart"></i>
                    </button>
                  @else
                    <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                      <i class="fa fa-heart-o"></i>
                    </button>
                  @endif
                @else
                  <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                    <i class="fa fa-heart-o"></i>
                  </button>
                @endif
              @endauth

              {{--add to compare--}}
              <button type="button" class="wishlist" data-toggle="tooltip" id="{{ $product->id }}"
                      title="افزودن به مقایسه" onClick="add_to_compare(id)">
                <i class="fa fa-exchange"></i>
              </button>
            </div>
          </div>
        </div>
      @endforeach
    </div>


    <!-- Featured محصولات End-->
    <!-- Banner Start-->
    <div class="marketshop-banner my-3">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="#"><img title="بنر نمونه 2" alt="بنر نمونه 2" src="image/banner/sample-banner-3-360x360.jpg"></a></div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="#"><img title="بنر نمونه" alt="بنر نمونه" src="image/banner/sample-banner-1-360x360.jpg"></a></div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="#"><img title="بنر نمونه 3" alt="بنر نمونه 3" src="image/banner/sample-banner-2-360x360.jpg"></a></div>
      </div>
    </div>
    <!-- Banner End-->


    <!-- دسته ها محصولات Slider Start-->
    <div class="category-module" id="latest_category">
      <h3 class="subtitle">الکترونیکی - <a class="viewall" href="{{ url('category/1') }}">نمایش همه</a></h3>
      <div class="category-module-content">
        <ul id="sub-cat" class="tabs">
          @foreach($mycats as $cat)
            <li><a href="#tab-cat{{ $cat->id }}">{{ $cat->name }}</a></li>
          @endforeach
        </ul>

        <div id="tab-cat10" class="tab_content">
          @if(sizeof($tab_cat10_products) == 0)
            <p class="alert alert-warning text-center">محصولی در این دسته موجود نیست!</p>
          @else
            <div class="owl-carousel latest_category_tabs">
              @foreach($tab_cat10_products as $product)
                <div class="product-thumb">
                  <div class="image"><a href="{{ $product->slug }}">
                      <img src="{{ url('uploads/images/indexes/'. $product->indexImage) }}"
                           alt="{{ $product->title }}"  class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="{{ $product->slug }}">{{ $product->title }}</a></h4>
                    <p class="price"> <span class="price-new">{{ $product->offprice }} تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                      <?php
                      $reviews = App\Review::where('product_id', $product->id)
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
                  </div>


                    <div class="button-group">
                    {{--add to cart--}}
                    <input type="hidden" name="quantity" value="1" id="input-quantity" />
                    <input type="hidden" name="color" value="1" id="sel_color" />
                    <button class="btn-primary addToCart" type="button" id="{{ $product->id }}"><span>افزودن به سبد</span></button>

                    {{--add to favs--}}
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
                          <i class="fa fa-heart-o"></i>
                        </button>
                      @endguest
                      @auth
                        @if (!empty($isFav))
                          @if ($isFav->isFavorite == 1)
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="حذف از علاقه مندی ها">
                              <i class="fa fa-heart"></i>
                            </button>
                          @else
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                              <i class="fa fa-heart-o"></i>
                            </button>
                          @endif
                        @else
                          <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                            <i class="fa fa-heart-o"></i>
                          </button>
                        @endif
                      @endauth

                      {{--add to compare--}}
                      <button type="button" class="wishlist" data-toggle="tooltip" title="افزودن به مقایسه"
                              onClick="add_to_compare(id)" id="{{ $product->id }}">
                        <i class="fa fa-exchange"></i>
                      </button>
                    </div>
                  </div>
                </div>
              @endforeach
              @endif
            </div>
        </div>
        <div id="tab-cat12" class="tab_content">
          @if(sizeof($tab_cat12_products) == 0)
            <p class="alert alert-warning text-center">محصولی در این دسته موجود نیست!</p>
          @else
            <div class="owl-carousel latest_category_tabs">
              @foreach($tab_cat12_products as $product)
                <div class="product-thumb">
                  <div class="image"><a href="{{ $product->slug }}">
                      <img src="{{ url('uploads/images/indexes/'. $product->indexImage) }}"
                           alt="{{ $product->title }}"  class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="{{ $product->slug }}">{{ $product->title }}</a></h4>
                    <p class="price"> <span class="price-new">{{ $product->offprice }} تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                      <?php
                      $reviews = App\Review::where('product_id', $product->id)
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
                  </div>


                    <div class="button-group">
                    {{--add to cart--}}
                    <input type="hidden" name="quantity" value="1" id="input-quantity" />
                    <input type="hidden" name="color" value="1" id="sel_color" />
                    <button class="btn-primary addToCart" type="button" id="{{ $product->id }}"><span>افزودن به سبد</span></button>

                    {{--add to favs--}}
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
                          <i class="fa fa-heart-o"></i>
                        </button>
                      @endguest
                      @auth
                        @if (!empty($isFav))
                          @if ($isFav->isFavorite == 1)
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="حذف از علاقه مندی ها">
                              <i class="fa fa-heart"></i>
                            </button>
                          @else
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                              <i class="fa fa-heart-o"></i>
                            </button>
                          @endif
                        @else
                          <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                            <i class="fa fa-heart-o"></i>
                          </button>
                        @endif
                      @endauth

                      {{--add to compare--}}
                      <button type="button" class="wishlist" data-toggle="tooltip" title="افزودن به مقایسه"
                              onClick="add_to_compare(id)" id="{{ $product->id }}">
                        <i class="fa fa-exchange"></i>
                      </button>
                    </div>
                  </div>
                </div>
              @endforeach
              @endif
            </div>
        </div>
        <div id="tab-cat13" class="tab_content">
          @if(sizeof($tab_cat13_products) == 0)
            <p class="alert alert-warning text-center">محصولی در این دسته موجود نیست!</p>
          @else
            <div class="owl-carousel latest_category_tabs">
              @foreach($tab_cat13_products as $product)
                <div class="product-thumb">
                  <div class="image"><a href="{{ $product->slug }}">
                      <img src="{{ url('uploads/images/indexes/'. $product->indexImage) }}"
                           alt="{{ $product->title }}"  class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="{{ $product->slug }}">{{ $product->title }}</a></h4>
                    <p class="price"> <span class="price-new">{{ $product->offprice }} تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                      <?php
                      $reviews = App\Review::where('product_id', $product->id)
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
                  </div>


                    <div class="button-group">
                    {{--add to cart--}}
                    <input type="hidden" name="quantity" value="1" id="input-quantity" />
                    <input type="hidden" name="color" value="1" id="sel_color" />
                    <button class="btn-primary addToCart" type="button" id="{{ $product->id }}"><span>افزودن به سبد</span></button>

                    {{--add to favs--}}
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
                          <i class="fa fa-heart-o"></i>
                        </button>
                      @endguest
                      @auth
                        @if (!empty($isFav))
                          @if ($isFav->isFavorite == 1)
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="حذف از علاقه مندی ها">
                              <i class="fa fa-heart"></i>
                            </button>
                          @else
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                              <i class="fa fa-heart-o"></i>
                            </button>
                          @endif
                        @else
                          <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                            <i class="fa fa-heart-o"></i>
                          </button>
                        @endif
                      @endauth

                      {{--add to compare--}}
                      <button type="button" class="wishlist" data-toggle="tooltip" title="افزودن به مقایسه"
                              onClick="add_to_compare(id)" id="{{ $product->id }}">
                        <i class="fa fa-exchange"></i>
                      </button>
                    </div>
                  </div>
                </div>
              @endforeach
              @endif
            </div>
        </div>
        <div id="tab-cat15" class="tab_content">
          @if(sizeof($tab_cat15_products) == 0)
            <p class="alert alert-warning text-center">محصولی در این دسته موجود نیست!</p>
          @else
            <div class="owl-carousel latest_category_tabs">
              @foreach($tab_cat15_products as $product)
                <div class="product-thumb">
                  <div class="image"><a href="{{ $product->slug }}">
                      <img src="{{ url('uploads/images/indexes/'. $product->indexImage) }}"
                           alt="{{ $product->title }}"  class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="{{ $product->slug }}">{{ $product->title }}</a></h4>
                    <p class="price"> <span class="price-new">{{ $product->offprice }} تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                      <?php
                      $reviews = App\Review::where('product_id', $product->id)
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
                  </div>


                    <div class="button-group">
                    {{--add to cart--}}
                    <input type="hidden" name="quantity" value="1" id="input-quantity" />
                    <input type="hidden" name="color" value="1" id="sel_color" />
                    <button class="btn-primary addToCart" type="button" id="{{ $product->id }}"><span>افزودن به سبد</span></button>

                    {{--add to favs--}}
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
                          <i class="fa fa-heart-o"></i>
                        </button>
                      @endguest
                      @auth
                        @if (!empty($isFav))
                          @if ($isFav->isFavorite == 1)
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="حذف از علاقه مندی ها">
                              <i class="fa fa-heart"></i>
                            </button>
                          @else
                            <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                              <i class="fa fa-heart-o"></i>
                            </button>
                          @endif
                        @else
                          <button type="button" class="wishlist addFav" id="{{ $product->id }}" title="افزودن به علاقه مندی ها">
                            <i class="fa fa-heart-o"></i>
                          </button>
                        @endif
                      @endauth

                      {{--add to compare--}}
                      <button type="button" class="wishlist" data-toggle="tooltip" title="افزودن به مقایسه"
                              onClick="add_to_compare(id)" id="{{ $product->id }}">
                        <i class="fa fa-exchange"></i>
                      </button>
                    </div>
                  </div>
                </div>
              @endforeach
              @endif
            </div>
        </div>

      </div>
    </div>
    <!-- دسته ها محصولات Slider End-->

    <!-- Banner Start -->
    <div class="marketshop-banner my-3">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="#"><img title="1 Block Banner" alt="1 Block Banner" src="image/banner/1blockbanner-1140x75.jpg"></a></div>
      </div>
    </div>
    <!-- Banner End -->

    <!-- برند Logo Carousel Start-->
    <div id="carousel" class="owl-carousel nxt my-3">
      @foreach($brands as $brand)
        <div class="item text-center">
          <a href="{{ url('brand/'. $brand->name) }}">
            <img src="{{ url('uploads/images/'. $brand->image) }}"
                 alt="{{ $brand->name }}" class="img-responsive" /></a>
        </div>
      @endforeach
    </div>
    <!-- برند Logo Carousel End -->
  </div>

@endsection

@section('Feature Box')
  <div class="custom-feature-box row">
    <div class="col-sm-4 col-xs-12">
      <div class="feature-box fbox_1">
        <div class="title">ارسال رایگان</div>
        <p>برای خرید های بیش از 100 هزار تومان</p>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="feature-box fbox_3">
        <div class="title">کارت هدیه</div>
        <p>بهترین هدیه برای عزیزان شما</p>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="feature-box fbox_4">
        <div class="title">امتیازات خرید</div>
        <p>از هر خرید امتیاز کسب کرده و از آن بهره بگیرید</p>
      </div>
    </div>
  </div>
@endsection