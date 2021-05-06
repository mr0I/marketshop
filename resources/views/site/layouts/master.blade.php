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
                                <li class="email"><a href="mailto:cadcamcae65@yahoo.com"><i class="fa fa-envelope"></i>cadcamcae65@yahoo.com</a></li>
                                <li class="wrap_custom_block hidden-sm hidden-xs"><a>بلاک سفارشی<b></b></a>
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
                                                        <td><h4>بلاک های محتوا</h4></td>
                                                        <td><h4>قالب واکنش گرا</h4></td>
                                                    </tr>
                                                    <tr>
                                                        <td>این یک بلاک مدیریت محتواست. شما میتوانید هر نوع محتوای html نوشتاری یا تصویری را در آن قرار دهید.</td>
                                                        <td>این یک بلاک مدیریت محتواست. شما میتوانید هر نوع محتوای html نوشتاری یا تصویری را در آن قرار دهید.</td>
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

                                <li><a href="{{ url('wishlist') }}">لیست علاقه مندی ({{ $fav_count }})</a></li>
                            </ul>
                        </div>
                        <div id="language" class="btn-group">
                            <button class="btn-link dropdown-toggle" data-toggle="dropdown"> <span> <img src="{{ url('image/flags/gb.png') }}" alt="انگلیسی" title="انگلیسی">انگلیسی <i class="fa fa-caret-down"></i></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="btn btn-link btn-block language-select" type="button" name="GB"><img src="{{ url('image/flags/gb.png') }}" alt="انگلیسی" title="انگلیسی" /> انگلیسی</button>
                                </li>
                                <li>
                                    <button class="btn btn-link btn-block language-select" type="button" name="GB"><img src="{{ url('image/flags/ar.png') }}" alt="عربی" title="عربی" /> عربی</button>
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
                        @if (Auth::guest())
                            <ul>
                                <li><a href="{{ route('login') }}">ورود</a></li>
                                <li><a href="{{ route('register') }}">ثبت نام</a></li>
                            </ul>
                        @else
                            @if(!Auth::user()->is_admin == 'false')
                                <div id="user_dd" class="btn-group">
                                    @if (Auth::user()->name == 'your-name')
                                        <span>خوش آمدید </span>
                                    @else
                                        <span>خوش آمدید {{ Auth::user()->name }}</span>
                                    @endif
                                    <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <span><i class="fa fa-user"></i></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/admin') }}">پنل کاربری</a>
                                        </li>
                                        <br>
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/logout') }}"
                                               onclick="event.preventDefault();document.getElementById('logout-form').submit()">خروج</a>
                                        </li>
                                    </ul>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            @else
                                <div id="admin_dd" class="btn-group">
                                    <span>خوش آمدید {{ Auth::user()->name }}</span>
                                    <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                                        <span><i class="fa fa-user-secret"></i></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/admin') }}">ورود به پنل مدیریت</a>
                                        </li>
                                        <br>
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/logout') }}"
                                               onclick="event.preventDefault();document.getElementById('logout-form').submit()">خروج</a>
                                        </li>
                                    </ul>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
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
                        <input id="filter_name" type="text" name="s" value="" placeholder="جستجوی محصولات..." class="form-control input-lg" />
                        <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- جستجو End-->
            <!-- Mini Cart Start-->
            <div class="col-table-cell col-lg-3 col-md-3 col-md-pull-0 col-sm-6 col-sm-pull-6 col-xs-12 inner">
                <div id="cart">
                    @if ($count==0 && $price==0)
                        <button type="button" data-toggle="dropdown" data-loading-text="بارگذاری ..." class="heading dropdown-toggle"> <span class="cart-icon pull-left flip"></span> <span id="cart-total">سبد خرید خالی است</span>
                        </button>
                    @else
                        <button type="button" data-toggle="dropdown" data-loading-text="بارگذاری ..." class="heading dropdown-toggle"> <span class="cart-icon pull-left flip"></span> <span id="cart-total">{{ $count }} آیتم - {{ $price }} تومان</span>
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
                                        <strong>سبد خرید خالی است!</strong>
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
                                    <a href="{{ url('/checkout') }}" class="btn btn-primary" @if(sizeof($cart_products) == 0) disabled @endif><i class="fa fa-share"></i> تسویه حساب</a>
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
<!-- Main آقایانu Start-->
<nav id="menu" class="navbar">
    <div class="container">
        <div class="navbar-header"> <span class="visible-xs visible-sm"> منو <b></b></span></div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a class="home_link" title="خانه" href="{{ url('/') }}"><span>خانه</span></a></li>
                <li class="dropdown"><a>خرید بر اساس دسته بندی</a>
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
                <li class="dropdown information-link"><a>برگه ها</a>
                    <div class="dropdown-menu">
                        <ul>
                            @if(Auth::check())
                                <li ><a href="{{ url('/') }}" class="block_cursor">ورود</a></li>
                                <li><a href="{{ url('/') }}" class="block_cursor">ثبت نام</a></li>
                                @else
                                <li><a href="{{ route('login') }}">ورود</a></li>
                                <li><a href="{{ route('register') }}">ثبت نام</a></li>
                            @endif
                            <li><a href="{{ route('cart.index') }}">سبد خرید</a></li>
                            <li><a href="{{ url('checkout') }}">تسویه حساب</a></li>
                            <li><a href="{{ url('compare') }}">مقایسه</a></li>
                            <li><a href="{{ url('wishlist') }}">لیست آرزو</a></li>
                            <li><a href="{{ url('search') }}">جستجو</a></li>
                            <li><a href="{{ url('aboutus') }}">درباره ما</a></li>
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

<!-- Main آقایانu End-->
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
                        <li class="address"><i class="fa fa-map-marker"></i>میدان تایمز، شماره 77، نیویورک</li>
                        <li class="mobile"><i class="fa fa-phone"></i>+21 9898777656</li>
                    </ul>
                </div>
                <div class="column col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <h5>اطلاعات</h5>
                    <ul>
                        <li><a href="{{ url('aboutus') }}">درباره ما</a></li>
                        <li><a href="#">حریم خصوصی</a></li>
                        <li><a href="#">شرایط و قوانین</a></li>
                        <li><a href="#">نقشه سایت</a></li>
                    </ul>
                </div>
                <div class="column col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <h5>حساب من</h5>
                    <ul>
                        @if(Auth::check())
                            <li><a href="{{ url('/admin') }}">حساب کاربری</a></li>
                            @else
                            <li><a href="{{ url('/register') }}">حساب کاربری</a></li>
                        @endif
                        <li><a href="#">تاریخچه سفارشات</a></li>
                        <li><a href="{{ url('wishlist') }}">لیست علاقه مندی</a></li>
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
                    <p>کپی رایت © 2020 فروشگاه شما<a href="http://cadcammedia.ir/" target="_blank">Unco</a></p>
                </div>
                <div class="social pull-right flip"> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/facebook.png') }}" alt="Facebook" title="Facebook"></a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/twitter.png') }}" alt="Twitter" title="Twitter"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/google_plus.png') }}" alt="Google+" title="Google+"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/pinterest.png') }}" alt="Pinterest" title="Pinterest"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="{{ url('image/socialicons/rss.png') }}" alt="RSS" title="RSS"> </a> </div>
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
<script>
    $(document).ready(function () {
        $('#cat_accordion').cutomAccordion({
            saveState: false,
            autoExpand: true
        });
    });
</script>
@yield('scripts')
<!-- JS Part End-->
</body>
</html>