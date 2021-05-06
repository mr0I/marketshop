@extends('site.layouts.master')


@section('title')
  {{$product->title}} | محصولات
@endsection


@section('content')

@if (\Session::has('review_message'))
<script>alert('بازخورد شما ثبت شد.')</script>
@endif

@if (\Session::has('review_error'))
<div class="alert alert-danger alert-dismissible" role="alert" id="reviewAlert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  {{ \Session::get('review_error') }}
</div>
@endif

<!-- Breadcrumb Start-->
<ul class="breadcrumb">
  <li itemscope><a href="{{ url('/') }}" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
  @if ($parentcat->id != null)
  <li itemscope><a href="{{ url('category/'.$parentcat->id) }}" itemprop="url">
    <span itemprop="title">{{ $parentcat->name }}</span></a></li>
    <li itemscope><a href="{{ url('category/'.$cat->id) }}" itemprop="url">
      <span itemprop="title">{{ $cat->name }}</span></a></li>
      @else
      <li itemscope><a href="{{ url('category/'.$cat->id) }}" itemprop="url">
        <span itemprop="title">{{ $cat->name }}</span></a></li>
        @endif
        <li itemscope><a href="{{ url('product/'.$product->slug) }}" itemprop="url">
          <span itemprop="title">{{ $product->title }}</span></a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
          <!--Right Part Start -->
          <aside id="column-left" class="col-sm-3 hidden-xs">
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
                  <div class="image"><a href="{{ url('product/'.$product->slug) }}">
                    <img src="{{ url('uploads/images/indexes/'.$product->indexImage) }}" alt=" {{$product->title}}" title=" {{$product->title}} " class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="{{ url('product/'.$product->slug) }}">{{$product->title}}</a></h4>
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
              <!--Right Part End -->

              <!--Middle Part Start-->
              <div id="content" class="col-sm-9">
                <div itemscope>
                  <h2 class="title">{{ $selfproduct->title }}</h2>
                  <div class="row product-info">
                    <div class="col-sm-6">
                      <div class="image">
                        <img class="img-responsive" itemprop="image" id="zoom_01"
                        src="{{ url('uploads/images/indexes/'. $selfproduct->indexImage) }}"
                        data-zoom-image="{{ url('uploads/images/indexes/'. $selfproduct->indexImage) }}" />
                      </div>
                      <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> برای مشاهده گالری روی تصویر کلیک کنید</span></div>
                      <div class="image-additional" id="gallery_01">
                        @foreach ($gallery_images as $image)
                        <a class="thumbnail" href="#"
                        data-zoom-image="{{ url('uploads/images/gallery/'.$image->image) }}"
                        data-image="{{ url('uploads/images/gallery/'.$image->image) }}" >
                        <img src="{{ url('uploads/images/gallery/'.$image->image) }}" alt = "{{ $image->image }}"/></a>
                        @endforeach
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <ul class="list-unstyled description">
                        <li><b>برند :</b> <a href="{{ url('brand/'.$selfproduct->brand) }}">
                          <span itemprop="brand">{{ $selfproduct->brand }}</span></a></li>
                          <li><b>کد محصول :</b> <span itemprop="mpn">{{ $selfproduct->code }}</span></li>

                            @if ($selfproduct->availablity == 1)
                          <li><b>وضعیت موجودی :</b><span class="instock">موجود</span></li>
                            @else
                          <li><b>وضعیت موجودی :</b><span class="bg-danger p-2">ناموجود</span></li>
                            @endif
                          </ul>
                          <ul class="price-box">
                            @if ($selfproduct->price != $selfproduct->offprice)
                            <li class="price" itemprop="offers" itemscope>
                              <span class="price-old">{{ $selfproduct->price }}</span>
                              <span itemprop="price">{{ $selfproduct->offprice }}</span>
                            </li>
                              @else
                              <li class="price" itemprop="offers" itemscope>
                              <span itemprop="price">{{ $selfproduct->offprice }}</span>
                            </li>
                              @endif
                            </ul>
                            <div id="product">
                              <h3 class="subtitle">انتخاب های در دسترس</h3>
                              <div class="form-group required">
                                <label class="control-label" for="sel_color">رنگ</label>
                                <select id="sel_color" name="">
                                  <option value="" disabled> --- لطفا انتخاب کنید --- </option>
                                  @foreach ($selfproduct->colors as $color)
{{--                                  @foreach ($selfproduct->colors as $key=>$color)--}}
                                  <option value="{{ $color->id }}">{{ $color->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="cart">
                                <div>
                                  <div class="qty">
                                    <label class="control-label" for="input-quantity">تعداد</label>
                                    <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
                                    <a class="qtyBtn plus" href="javascript:void(0);">+</a><br />
                                    <a class="qtyBtn mines" href="javascript:void(0);">-</a>
                                    <div class="clear"></div>
                                  </div>
                                  <button type="button" id="{{ $selfproduct->id }}" class="btn btn-primary btn-lg addToCart">افزودن به سبد</button>
                                </div>
                                <div>
                                  @guest
                                    <button type="button" disabled class="wishlist addFav"
                                            id="{{ $selfproduct->id }}" title="برای اینکار باید لاگین کنید!">
                                      <i class="fa fa-heart-o"></i> افزودن به علاقه مندی ها
                                    </button>
                                  @endguest
                                    @auth
                                      @if (!empty($isFav))
                                        @if ($isFav->isFavorite == 1)
                                          <button type="button" class="wishlist addFav" id="{{ $selfproduct->id }}">
                                            <i class="fa fa-heart"></i> حذف از علاقه مندی ها
                                          </button>
                                        @else
                                          <button type="button" class="wishlist addFav" id="{{ $selfproduct->id }}">
                                            <i class="fa fa-heart-o"></i> افزودن به علاقه مندی ها
                                          </button>
                                        @endif
                                      @else
                                        <button type="button" class="wishlist addFav" id="{{ $selfproduct->id }}">
                                          <i class="fa fa-heart-o"></i> افزودن به علاقه مندی ها
                                        </button>
                                      @endif
                                    @endauth
                                <br />
                                <button type="button" id="{{ $selfproduct->id }}" class="wishlist"
                                        onClick="add_to_compare(id)"><i class="fa fa-exchange"></i> مقایسه این محصول</button>
                              </div>
                            </div>
                          </div>

                          @if ($vote == 0)
                          <div class="rating">
                            <span class="fa fa-stack">
                              <img src="{{ url('image/rating/0.png') }}" alt="" width="200">
                            </span>
                          </div>
                          @elseif($vote >0 && $vote <= 1)
                          <div class="rating">
                            <span class="fa fa-stack">
                              <img src="{{ url('image/rating/1.png') }}" alt="" width="200">
                            </span>
                          </div>
                          @elseif($vote >1 && $vote <= 2)
                          <div class="rating">
                            <span class="fa fa-stack">
                              <img src="{{ url('image/rating/2.png') }}" alt="" width="200">
                            </span>
                          </div>
                          @elseif($vote >2 && $vote <= 3)
                          <div class="rating">
                            <span class="fa fa-stack">
                              <img src="{{ url('image/rating/3.png') }}" alt="" width="200">
                            </span>
                          </div>
                          @elseif($vote >3 && $vote <= 4)
                          <div class="rating">
                            <span class="fa fa-stack">
                              <img src="{{ url('image/rating/4.png') }}" alt="" width="200">
                            </span>
                          </div>
                          @elseif($vote >4 && $vote <= 5)
                          <div class="rating">
                            <span class="fa fa-stack">
                              <img src="{{ url('image/rating/5.png') }}" alt="" width="200">
                            </span>
                          </div>
                          @endif
                          <br>
                          <a  onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">یک بررسی بنویسید</a>
                          <hr>
                        </div>
                      </div>
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-description" data-toggle="tab">توضیحات</a></li>
                        <li><a href="#tab-specification" data-toggle="tab">مشخصات</a></li>
                        <li><a href="#tab-review" data-toggle="tab">بررسی ({{ $reviews->count() }})</a></li>
                      </ul>
                      <div class="tab-content">
                        <div itemprop="description" id="tab-description" class="tab-pane active">
                          {!! $selfproduct->description !!}
                        </div>

                        <div id="tab-specification" class="tab-pane">
                          <div id="tab-specification" class="tab-pane">
                            @foreach ($specifications as $spec)
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <td colspan="2"><strong>{{ $spec->title }}</strong></td>
                                </tr>
                              </thead>
                              <tbody>
                                @if ($spec->spec1 != '')
                                <tr>
                                  <td>{{ $spec->spec1 }}</td>
                                  <td>{{ $spec->desc1 }}</td>
                                </tr>
                                @endif
                                @if ($spec->spec2 != '')
                                <tr>
                                  <td>{{ $spec->spec2 }}</td>
                                  <td>{{ $spec->desc2 }}</td>
                                </tr>
                                @endif
                                @if ($spec->spec3 != '')
                                <tr>
                                  <td>{{ $spec->spec3 }}</td>
                                  <td>{{ $spec->desc3 }}</td>
                                </tr>
                                @endif
                              </tbody>
                            </table>

                            @endforeach

                          </div>
                        </div>
                        <div id="tab-review" class="tab-pane">
                          <form class="form-horizontal" method="POST" action="{{ url('addReviews') }}"
                          id="reviewFrm">
                          @csrf
                          <div id="review">
                            <div>
                              @foreach ($reviews as $review)
                              <table class="table table-striped table-bordered">
                                <tbody>
                                  <tr>
                                    <td style="width: 50%;"><strong><span>{{ $review->name }}</span></strong></td>
                                    <td class="text-right"><span>{{ $review->created_at }}</span></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">
                                      <p>{{ $review->text }}</p>
                                      @if ($review->vote == 0)
                                      <div class="rating">
                                        <span class="fa fa-stack">
                                          <img src="{{ url('image/rating/0.png') }}" alt="" width="120">
                                        </span>
                                      </div>
                                      @elseif($review->vote >0 && $review->vote <= 1)
                                      <div>
                                        <span class="fa fa-stack">
                                          <img src="{{ url('image/rating/1.png') }}" alt="" width="120">
                                        </span>
                                      </div>
                                      @elseif($review->vote >1 && $review->vote <= 2)
                                      <div class="rating">
                                        <span class="fa fa-stack">
                                          <img src="{{ url('image/rating/2.png') }}" alt="" width="120">
                                        </span>
                                      </div>
                                      @elseif($review->vote >2 && $review->vote <= 3)
                                      <div class="rating">
                                        <span class="fa fa-stack">
                                          <img src="{{ url('image/rating/3.png') }}" alt="" width="120">
                                        </span>
                                      </div>
                                      @elseif($review->vote >3 && $review->vote <= 4)
                                      <div class="rating">
                                        <span class="fa fa-stack">
                                          <img src="{{ url('image/rating/4.png') }}" alt="" width="120">
                                        </span>
                                      </div>
                                      @elseif($review->vote >4 && $review->vote <= 5)
                                      <div class="rating">
                                        <span class="fa fa-stack">
                                          <img src="{{ url('image/rating/5.png') }}" alt="" width="120">
                                        </span>
                                      </div>
                                      @endif
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              @endforeach
                            </div>
                            <div class="text-right"></div>
                          </div>

                          @if (!\Auth::guest())
                          <h2>یک بررسی بنویسید</h2>
                              <div class="form-group required">
                            <div class="col-sm-12">
                              <label for="input-name" class="control-label">نام شما</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" name="name"
                              >
                              @error('name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-group required">
                            <div class="col-sm-12">
                              <label for="input-review" class="control-label">بررسی شما</label>
                              <textarea class="form-control @error('text') is-invalid @enderror" id="input-review" rows="5" name="text"
                              ></textarea>
                              @error('text')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <div class="help-block"><span class="text-danger">توجه :</span> HTML بازگردانی نخواهد شد!</div>
                            </div>
                          </div>
                          <div class="form-group required">

                              <label class="control-label" style="margin-right: 20px;">امتیاز شما</label>
                            <div class="custom-rating">
                              <input class="rating__input hidden--visually" type="radio" id="5-star" name="vote" value="5" required />
                              <label class="rating__label" for="5-star" title="5 out of 5 custom-rating"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">5 out of 5 custom-rating</span></label>
                              <input class="rating__input hidden--visually" type="radio" id="4-star" name="vote" value="4" />
                              <label class="rating__label" for="4-star" title="4 out of 5 custom-rating"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">4 out of 5 custom-rating</span></label>
                              <input class="rating__input hidden--visually" type="radio" id="3-star" name="vote" value="3" />
                              <label class="rating__label" for="3-star" title="3 out of 5 custom-rating"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">3 out of 5 custom-rating</span></label>
                              <input class="rating__input hidden--visually" type="radio" id="2-star" name="vote" value="2" />
                              <label class="rating__label" for="2-star" title="2 out of 5 custom-rating"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">2 out of 5 custom-rating</span></label>
                              <input class="rating__input hidden--visually" type="radio" id="1-star" name="vote" value="1" />
                              <label class="rating__label" for="1-star" title="1 out of 5 custom-rating"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">1 out of 5 custom-rating</span></label>
                            </div>
                          </div>

                          <input type="hidden" value="{{ $selfproduct->id }}" name="product_id">
                          <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                          <div class="buttons">
                            <div class="pull-right">
                              <button type="submit" class="btn btn-primary" id="button-review" >ادامه</button>
                            </div>
                          </div>
                        </form>
                        @else
                        <div class="alert alert-danger show" role="alert">
                          <strong>خطا</strong> برای ثبت بررسی باید وارد شوید.
                          <a href="{{ route('login') }}" class="alert-link">ورود به سایت</a>
                        </div>
                        @endif
                      </div>
                    </div>
                    <h3 class="subtitle">محصولات مرتبط</h3>
                    <div class="owl-carousel related_pro">
                      @foreach ($similar_products as $product)
                      <?php
                      $offprice = $product->offprice;
                      $price = $product->price;
                      $decrease = round((($offprice-$price)/$price)*100 , 0);
                      ?>
                      <div class="product-thumb">
                        <div class="image"><a href="{{ url('product/'.$product->slug ) }}">
                          <img src="{{ url('uploads/images/indexes/'.$product->indexImage) }}" alt="{{ $product->title }}" title="{{ $product->title }}" class="img-responsive" /></a></div>
                          <div class="caption">
                            <h4><a href="{{ url('product/'.$product->slug) }}">{{ $product->title }}</a></h4>
                            <p class="price"> <span class="price-new">{{ $product->offprice }}</span>
                              @if ($price != $offprice)
                              <span class="price-old">{{ $product->price }}</span>
                              <span class="saving">{{ $decrease }} %</span>
                              @endif
                            </p>

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
                            <button class="btn-primary addToCart" type="button" id="{{ $product->id }}"><span>افزودن به سبد</span></button>
                          </div>
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
                          <button type="button" data-toggle="tooltip" id="{{ $product->id }}" class="wishlist" title="مقایسه این محصول"
                                  onClick="add_to_compare(id)"><i class="fa fa-exchange"></i>
                          </button>
                        </div>
                      </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <!--Middle Part End -->

                </div>


                @endsection