<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') | E-Shopper</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a rel="nofollow" href="tel:+70000000010"><i class="fa fa-phone"></i>&nbsp;+7 (000) 000-00-10</a></li>
                            <li><a href="mailto:info@domain.com" target="_blank"><i class="fa fa-envelope"></i>&nbsp;info@domain.com</a></li>
                            <li><a rel="nofollow" href="#"><i class="fa fa-map-marker"></i>&nbsp;Екатеринбург, ул. Лермонтова 17, 3 этаж, офис 4 </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-vk"></i></a></li>
                            <li><a href="#"><i class="fa fa-odnoklassniki"></i></a></li>                               
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-2">
                    <div class="logo pull-left">
                        <a href="{{route('allProducts')}}"><img src="{{asset('images/home/logo.png')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2 top-description">
                    <div>
                            Готовый интернет-магазин на Laravel
                    </div>                    
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a class="ajax-cart" href="{{route('cartproducts')}}"><i class="fa fa-shopping-cart"></i> Корзина
                                @if(request()->session()->has('cart'))
                                <span class="badge cart-badge">{{request()->session()->get('cart')->itemsNumber}}</span>
                                @endif</a></li>

                            @if(Auth::check())
                            <li><a href="{{route('home')}}"><i class="fa fa-lock"></i> Личный кабинет</a></li>
                            @else
                            <li><a href="{{route('login')}}"><i class="fa fa-lock"></i>Личный кабинет</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="{{route('allProducts')}}">Каталог</a></li>
                        <li><a href="{{route('contacts')}}">Контакты</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="search_box">
                    <form action="search" method="get">
                        <input type="text" name="searchText" placeholder="Поиск по каталогу"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-bottom-->
</header><!--/header--> 