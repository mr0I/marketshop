<!DOCTYPE html>
<html dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="{{ url('image/favicon.ico') }}" rel="icon" />
  {{--<title>{{ config('app.name') }}</title>--}}
  <title>@yield('title')</title>
  <meta name="keywords" content="@yield('keywords')">
  <meta name="description" content="@yield('description')">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('js/bootstrap/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('js/bootstrap/css/bootstrap-rtl.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/mymaterialize.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/materialize.rtl.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/jquery-ui.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/stylesheet.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/owl.carousel.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/owl.transitions.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/responsive.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/stylesheet-rtl.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/responsive-rtl.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('css/stylesheet-skin3.css') }}" />
  <link href="{{ url('libs/Toastr/toastr.min.css') }}" rel="stylesheet">
  <script src="{{ url('libs/Toastr/jquery.min.js') }}"></script>
  <script src="{{ url('libs/Toastr/toastr.min.js') }}"></script>
</head>
<body>

{!! Toastr::render() !!}

<div class="wrapper-wide">
  <div id="header">
    <!-- Top Bar Start-->
    <nav id="top" class="htop">
      <div class="container">
        <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
          <div class="pull-left flip left-top">
            <div class="links">
              <ul>
                <li class="mobile"><i class="fa fa-phone"></i>+21 9898777656</li>
                <li class="email"><a href="mailto:info@marketshop.com"><i class="fa fa-envelope"></i>info@marketshop.com</a></li>
                <li class="wrap_custom_block hidden-sm hidden-xs"><a>بلاک سفارشي<b></b></a>
                  <div class="dropdown-menu custom_block">
                    <ul>
                      <li>
                        <table>
                          <tbody>
                          <tr>
                            <td><img alt="" src="{{ url('image/banner/cms-block.jpg') }}"></td>
                            <td><img alt="" src="{{ url('image/banner/cms-block.jpg') }}"></td>
                          </tr>
                          <tr>
                            <td><h4>بلاک هاي محتوا</h4></td>
                            <td><h4>قالب واکنش گرا</h4></td>
                          </tr>
                          <tr>
                            <td>اين يک بلاک مديريت محتواست. شما ميتوانيد هر نوع محتواي html نوشتاري يا تصويري را در آن قرار دهيد.</td>
                            <td>اين يک بلاک مديريت محتواست. شما ميتوانيد هر نوع محتواي html نوشتاري يا تصويري را در آن قرار دهيد.</td>
                          </tr>
                          <tr>
                            <td><strong><a class="btn btn-default btn-sm" href="#">ادامه مطلب</a></strong></td>
                            <td><strong><a class="btn btn-default btn-sm" href="#">ادامه مطلب</a></strong></td>
                          </tr>
                          </tbody>
                        </table>
                      </li>
                    </ul>
                  </div>
                </li>
                <li><a href="#">ليست علاقه مندي (0)</a></li>
              </ul>
            </div>
            <div id="language" class="btn-group">
              <button class="btn-link dropdown-toggle" data-toggle="dropdown"> <span> <img src="{{ url('image/flags/gb.png') }}" alt="انگليسي" title="انگليسي">انگليسي <i class="fa fa-caret-down"></i></span></button>
              <ul class="dropdown-menu">
                <li>
                  <button class="btn btn-link btn-block language-select" type="button" name="GB"><img src="{{ url('image/flags/gb.png') }}" alt="انگليسي" title="انگليسي" /> انگليسي</button>
                </li>
                <li>
                  <button class="btn btn-link btn-block language-select" type="button" name="GB"><img src="{{ url('image/flags/ar.png') }}" alt="عربي" title="عربي" /> عربي</button>
                </li>
              </ul>
            </div>
            <div id="currency" class="btn-group">
              <button class="btn-link dropdown-toggle" data-toggle="dropdown"> <span> تومان <i class="fa fa-caret-down"></i></span></button>
              <ul class="dropdown-menu">
                <li>
                  <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro</button>
                </li>
                <li>
                  <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound Sterling</button>
                </li>
                <li>
                  <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ USD</button>
                </li>
              </ul>
            </div>
          </div>


          <div id="top-links" class="nav pull-right flip">
            @if (\Auth::guest())
              <ul>
                <li><a href="{{ route('login') }}">ورود</a></li>
                <li><a href="{{ route('register') }}">ثبت نام</a></li>
              </ul>
            @else
              @if(!\Auth::user()->is_admin == 'false')
                <ul class="ddown">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">پنل کاربري</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ url('/logout') }}"
                         onclick="event.preventDefault();document.getElementById('logout-form').submit()">خروج</a>
                    </div>
                  </li>
                  @if (Auth::user()->name == 'your-name')
                    <li><a href="#">خوش آمديد</a></li>
                  @else
                    <li><a href="#">خوش آمديد {{ Auth::user()->name }}</a></li>
                  @endif
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                    {{ csrf_field() }}
                  </form>
                </ul>
              @else
                <ul class="ddown">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-user-secret"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ url('/admin') }}">ورود به پنل مديريت</a>
                      <a class="dropdown-item" href="#">بخش ويدئوها</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ url('/logout') }}"
                         onclick="event.preventDefault();document.getElementById('logout-form').submit()">خروج</a>
                    </div>
                  </li>
                  <li><a href="#">خوش آمديد {{ Auth::user()->name }}</a></li>
                </ul>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                  {{ csrf_field() }}
                </form>
              @endif
            @endif
          </div>
        </div>
      </div>
    </nav>
    <!-- Top Bar End-->

    <!-- Header Start-->
    <header class="header-row">
      <div class="container">
        <div class="table-container">
          <!-- Logo Start -->
          <div class="col-table-cell col-lg-4 col-md-4 col-sm-12 col-xs-12 inner">
            <div id="logo"><a href="{{ url('/') }}"><img class="img-responsive" src="{{ url('image/logo.png') }}" title="MarketShop" alt="MarketShop" /></a></div>
          </div>
          <!-- Logo End -->
          <!-- جستجو Start-->
          <div class="col-table-cell col-lg-5 col-md-5 col-md-push-0 col-sm-6 col-sm-push-6 col-xs-12">
            <div id="search" class="input-group">
              <form action="{{ url('search') }}" method="get">
                <input id="filter_name" type="text" name="s" value="" placeholder="جستجو" class="form-control input-lg" />
                <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
              </form>
            </div>
          </div>
          <!-- جستجو End-->
          <!-- Mini Cart Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-md-pull-0 col-sm-6 col-sm-pull-6 col-xs-12 inner">
            <div id="cart">
              @if ($count==0 && $price==0)
                <button type="button" data-toggle="dropdown" data-loading-text="بارگذاري ..." class="heading dropdown-toggle"> <span class="cart-icon pull-left flip"></span> <span id="cart-total">سبد خريد خالي است</span>
                </button>
              @else
                <button type="button" data-toggle="dropdown" data-loading-text="بارگذاري ..." class="heading dropdown-toggle"> <span class="cart-icon pull-left flip"></span> <span id="cart-total">{{ $count }} آيتم - {{ $price }} تومان</span>
                </button>
              @endif

              <ul class="dropdown-menu">
                <li>
                  <table class="table">
                    <tbody>
                    <?php $totalprice = 0; ?>
                    @foreach ($cart_products as $cart_product)
                      <tr>
                        <td class="text-center">
                          <a href="{{ url('/product/'.$cart_product->slug) }}"><img class="img-thumbnail" alt="{{ $cart_product->title }}" src="{{ url('uploads/images/indexes/'.$cart_product->image) }}" style="width: 50px">
                          </a>
                        </td>
                        <td class="text-left"><a href="{{ url('/product/'.$cart_product->slug) }}">{{ $cart_product->title }}</a></td>
                        <td class="text-right">x {{ $cart_product->count }}</td>
                        <td class="text-right">{{ $cart_product->count * $cart_product->unitprice }} تومان</td>
                        <td class="text-center"><button type="button" class="btn btn-danger btn-xs remove" title="حذف"
                                                        id="{{ $cart_product->id }}"  onClick="del_cart_product(id)" ><i class="fa fa-times"></i></button></td>
                      </tr>
                      <?php $totalprice += ($cart_product->count) * ($cart_product->unitprice); ?>
                    @endforeach
                    </tbody>
                  </table>
                </li>
                <li>
                  <div>
                    @if (sizeof($cart_products) == 0)
                      <div class="alert alert-warning" role="alert">
                        <strong>سبد خريد خالي است!</strong>
                      </div>
                    @else
                      <table class="table table-bordered">
                        <tbody>
                        <tr>
                          <td class="text-right"><strong>جمع کل</strong></td>
                          <td class="text-right">{{ $totalprice }} تومان</td>
                        </tr>
                        </tbody>
                      </table>
                    @endif
                    <p class="checkout">
                      <a href="{{ route('cart.index') }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> مشاهده سبد</a>&nbsp;&nbsp;&nbsp;
                      <a href="{{ url('/checkout') }}" class="btn btn-primary" @if(sizeof($cart_products) == 0) disabled @endif><i class="fa fa-share"></i> تسويه حساب</a>
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- Mini Cart End-->
        </div>
      </div>
    </header>
    <!-- Header End-->
    <!-- Main آقايانu Start-->
    <nav id="menu" class="navbar">
      <div class="container">
        <div class="navbar-header"> <span class="visible-xs visible-sm"> منو <b></b></span></div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a class="home_link" title="خانه" href="{{ url('/') }}"><span>خانه</span></a></li>
            <li class="dropdown"><a>خريد بر اساس دسته بندي</a>
              <div class="dropdown-menu">
                <ul>
                  @foreach ($categories as $category)
                    @if ($category->getChild->count()>0)
                      <li> <a href="{{url('category/'.$category->id)}}">{{$category->name}}<span>&rsaquo;</span></a>
                        <div class="dropdown-menu">
                          <ul>
                            @foreach ($category->getChild as $submenu)
                              @if ($submenu->getChild->count()>0)
                                <li><a href="{{url('category/'.$category->id.'/'.$submenu->id)}}">{{$submenu->name}}<span>&rsaquo;</span></a>
                                  <div class="dropdown-menu">
                                    <ul>
                                      @foreach ($submenu->getChild as $submenu2)
                                        <li><a href="{{url('category/'.$category->id.'/'.$submenu->id.'/'.$submenu2->id)}}" >{{$submenu2->name}}</a></li>
                                      @endforeach
                                    </ul>
                                  </div>
                              @else
                                <li><a href="{{url('category/'.$category->id.'/'.$submenu->id)}}" >{{$submenu->name}}</a></li>
                              @endif
                            @endforeach
                          </ul>
                        </div>
                      </li>
                    @else
                      <li><a href="{{url('category/'.$category->id)}}">{{$category->name}}</a>
                    @endif
                  @endforeach
                </ul>
              </div>
            </li>
            <li class="menu_brands dropdown"><a href="#">برند ها</a>
              <div class="dropdown-menu">
                @foreach ($brands as $brand)
                  <div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">
                    <a href="{{ url('brand/'.$brand->name) }}">
                      @if ($brand->image != null)
                        <img src="{{url('uploads/images/' . $brand->image)}}" alt="{{$brand->name}}" width="40" height="40" />
                      @else
                        <img src="{{url('image/no_image.jpg')}}" width="40" height="40" />
                      @endif
                    </a> <a href="{{ url('brand/'.$brand->name) }}">{{ $brand->name }}</a>
                  </div>
                @endforeach
              </div>
            </li>
            <li class="custom-link"><a href="#">لينک هاي دلخواه</a></li>

            <li class="dropdown information-link"><a>برگه ها</a>
              <div class="dropdown-menu">
                <ul>
                  <li><a href="{{ route('login') }}">ورود</a></li>
                  <li><a href="register.html">ثبت نام</a></li>
                  <li><a href="category.html">دسته بندي (شبکه/ليست)</a></li>
                  <li><a href="product.html">محصولات</a></li>
                  <li><a href="cart.html">سبد خريد</a></li>
                  <li><a href="checkout.html">تسويه حساب</a></li>
                  <li><a href="compare.html">مقايسه</a></li>
                  <li><a href="wishlist.html">ليست آرزو</a></li>
                  <li><a href="search.html">جستجو</a></li>
                </ul>
                <ul>
                  <li><a href="about-us.html">درباره ما</a></li>
                  <li><a href="404.html">404</a></li>
                  <li><a href="elements.html">عناصر</a></li>
                  <li><a href="faq.html">سوالات متداول</a></li>
                  <li><a href="sitemap.html">نقشه سايت</a></li>
                  <li><a href="contact-us.html">تماس با ما</a></li>
                </ul>
              </div>
            </li>
            <li class="contact-link"><a href="{{ url('contact_us') }}">تماس با ما</a></li>
            <li class="custom-link-right">
              <a href="{{ url('compare') }}" target="_blank">محصولات مقایسه
                <span class="badge" id="compareCount"
                      style="margin-top: 10px;background-color: lightcoral;">
                        {{ (\Session::has('compare_count'))? \Session::get('compare_count') : 0 }}
                    </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main آقايانu End-->
  </div>

  <div id="container">
    <div class="container">
      @yield('content')
    </div>
  </div>

  <!--Footer Start-->
  <footer id="footer">
    <div class="fpart-first">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h5>اطلاعات تماس</h5>
            <ul>
              <li class="address"><i class="fa fa-map-marker"></i>ميدان تايمز، شماره 77، نيويورک</li>
              <li class="mobile"><i class="fa fa-phone"></i>+21 9898777656</li>
              <li class="email"><i class="fa fa-envelope"></i>برقراري ارتباط از طريق <a href="contact-us.html">تماس با ما</a>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>اطلاعات</h5>
            <ul>
              <li><a href="{{ url('aboutus') }}">درباره ما</a></li>
              <li><a href="about-us.html">اطلاعات 0 تومان</a></li>
              <li><a href="about-us.html">حريم خصوصي</a></li>
              <li><a href="about-us.html">شرايط و قوانين</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>خدمات مشتريان</h5>
            <ul>
              <li><a href="contact-us.html">تماس با ما</a></li>
              <li><a href="#">بازگشت</a></li>
              <li><a href="sitemap.html">نقشه سايت</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>امکانات جانبي</h5>
            <ul>
              <li><a href="#">برند ها</a></li>
              <li><a href="#">کارت هديه</a></li>
              <li><a href="#">بازاريابي</a></li>
              <li><a href="#">ويژه ها</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>حساب من</h5>
            <ul>
              <li><a href="#">حساب کاربري</a></li>
              <li><a href="#">تاريخچه سفارشات</a></li>
              <li><a href="#">ليست علاقه مندي</a></li>
              <li><a href="#">خبرنامه</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="fpart-second">
      <div class="container">
        <div id="powered" class="clearfix">
          <div class="powered_text pull-left flip">
            <p>کپي رايت © 2016 فروشگاه شما<a href="http://www.20script.ir" target="_blank">بيست اسکريپت</a></p>
          </div>
          <div class="social pull-right flip"> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/facebook.png') }}" alt="Facebook" title="Facebook"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/twitter.png') }}" alt="Twitter" title="Twitter"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/google_plus.png') }}" alt="Google+" title="Google+"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/pinterest.png') }}" alt="Pinterest" title="Pinterest"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/rss.png') }}" alt="RSS" title="RSS"> </a> </div>
        </div>
        <div class="bottom-row">
          <div class="custom-text text-center"> <img alt="" src="{{ url('image/payment/payment_american.png') }}">
            <p>اين يک بلاک مديريت محتواست. شما ميتوانيد هر نوع محتواي html نوشتاري يا تصويري را در آن قرار دهيد. لورم ايپسوم يک متن آزمايشي براي پر کردن اين محل است..</p>
          </div>
          <div class="payments_types"> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/payment/payment_paypal.png') }}" alt="paypal" title="PayPal"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/payment/payment_american.png') }}" alt="american-express" title="American Express"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/payment/payment_2checkout.png') }}" alt="2checkout" title="2checkout"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/payment/payment_maestro.png') }}" alt="maestro" title="Maestro"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/payment/payment_discover.png') }}" alt="discover" title="Discover"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/payment/payment_mastercard.png') }}" alt="mastercard" title="MasterCard"></a> </div>
        </div>
      </div>
    </div>
    <div id="back-top"><a data-toggle="tooltip" title="بازگشت به بالا" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
  </footer>
  <!--Footer End-->
</div>
<!-- JS Part Start-->
<script type="text/javascript" src="{{ url('js/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ url('js/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/bootstrap/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.easing-1.3.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.elevateZoom-3.0.8.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/swipebox/lib/ios-orientationchange-fix.js') }}"></script>
<script type="text/javascript" src="{{ url('js/swipebox/src/js/jquery.swipebox.min.js') }}"></script>
<script src="{{ url('js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.dcjqaccordion.min.js') }}"></script>

<script type="text/javascript" src="{{ url('js/custom.js') }}"></script>
@yield('scripts')
<!-- JS Part End-->
</body>
</html>