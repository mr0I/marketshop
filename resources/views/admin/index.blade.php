<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ url('image/favicon.ico') }}" rel="icon" />
    <title>Admin panel</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('js/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/dashmaterialize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/materialize.rtl.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/Datatables.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/panelStyle.css') }}" />
    <link href="{{ url('libs/Toastr/toastr.min.css') }}" rel="stylesheet">
    <script src="{{ url('libs/Toastr/jquery.min.js') }}"></script>
    <script src="{{ url('libs/Toastr/toastr.min.js') }}"></script>
</head>
<body>

{!! Toastr::render() !!}

<?php
use Hekmatinasser\Verta\Verta;
?>


<nav class="navbar navbar-expand-lg navbar-dark topNav">
    <a class="navbar-brand pull-right" href="#">Logo</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="pull-left">
            <li class="nav-item">
            {{ verta() }}
            </li>
            <li class="nav-item dropdown mr-auto">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">person</i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('home')}}">بازگشت به سایت</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit()">خروج</a>
                </div>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</nav>

<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <div class="background"> <img src="{{ url('image/php.jpg') }}"> </div>
            <?php
            if (Auth::user()->profilepic == ''){
                if (Auth::user()->gender == 1){
                    $avatar_src = url('image/male-avatar.png');
                }else{
                    $avatar_src = url('image/female-avatar.png');
                }
            }else{
                $avatar_src = url('uploads/images/profile_pics').'/'.Auth::user()->profilepic;
            }
            ?>
            <a href="#"><img class="circle" src="{{ $avatar_src }}"></a>
            <p><span class="infos">نام کاربری: {{ Auth::user()->username }}</span></p>
            <p><span class="infos">ایمیل: {{ Auth::user()->email }}</span></p>
        </div>
    </li>
    <li class="menuItem"><a href="{{ url('admin/edit_profile') }}">
            <i class="material-icons">edit</i>ویرایش پروفایل</a></li>
    @if(Auth::user()->is_admin == 1)
    <li class="menuItem"><a href="{{ url('admin') }}"><i class="material-icons">dashboard</i>پیشخوان</a></li>
        <li class="menuItem"><a href="{{ url('admin/products') }}"><i class="material-icons">add_shopping_cart</i>محصولات</a></li>
        <li class="menuItem"><a href="{{ url('admin/category') }}"><i class="material-icons">view_list</i>دسته بندی ها</a>
        </li>
        <li class="menuItem"><a href="{{ url('admin/colors') }}"><i class="material-icons">color_lens</i>رنگ ها</a>
        </li>
        <li class="menuItem"><a href="{{ url('admin/brands') }}"><i class="material-icons">style</i>برندها</a>
        </li>
        <li class="menuItem d-flex">
            <a href="{{ url('admin/reviews') }}" style="width: 85%;"><i class="material-icons">comment</i>نظرات</a>
            <span class="badge badge-danger comment_badge"  style="width: 15%;">{{ $reviewCount }}</span>
        </li>
        <li class="menuItem"><a href="{{ url('admin/discounts') }}"><i class="material-icons">money_off</i>کد تخفیف</a></li>
        <li class="menuItem"><a href="{{ url('admin/videos') }}"><i class="material-icons">videocam</i>پیش نمایش</a></li>
        <li class="menuItem"><a href="{{ url('admin/sliders') }}"><i class="material-icons">slideshow</i>اسلایدر</a></li>
    @endif
</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i>
</a>

<!-- Content-Start -->
<div class="container">
    <div class="row" style="margin-top: 100px;">
        @yield('content')
    </div>
</div>
<!-- Content-End -->


<script src="{{ url('js/jquery-2.1.1.min.js') }}"></script>
<script src="{{ url('js/DataTables.js') }}"></script>
<script src="{{ url('js/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ url('js/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.elevateZoom-3.0.8.min.js') }}"></script>
<script src="{{ url('js/jquery.maskedinput.js') }}"></script>
<script src="{{ url('js/materialize.min.js') }}"></script>
<script src="{{ url('js/ckeditor.js') }}"></script>
<script src="{{ url('js/custom.js') }}"></script>
@yield('script')
</body>
</html>