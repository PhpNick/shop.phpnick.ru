<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
    <!-- bootstrap -->
    <link href="{{asset ('css/bootstrap-admin.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      main {
        margin-bottom: 50px; 
      }
    </style>   

    <!-- Custom styles for this template -->
    <link href="{{asset ('css/dashboard.css') }}" rel="stylesheet">


</head>

<body>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('adminDisplayProducts')}}">Панель администратора</a>
<ul class="navbar-nav px-3">
<li class="nav-item text-nowrap">
  <a class="nav-link" href="{{route('allProducts')}}">Вернуться на сайт</a>
</li>
</ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
           <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/products')!== false) ? 'active' : '' }}" href="{{route('adminDisplayProducts')}}">
            <span data-feather="shopping-cart"></span>
            Товары</a></li>
           <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/categoriesPanel')!== false) ? 'active' : '' }}" href="{{route('categoriesPanel')}}">
            <span data-feather="briefcase"></span>
            Категории</a></li>
           <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/brandsPanel')!== false) ? 'active' : '' }}" href="{{route('brandsPanel')}}">
            <span data-feather="globe"></span>
            Бренды</a></li>                        
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/ordersPanel')!== false) ? 'active' : '' }}" href="{{route('ordersPanel')}}">
            <span data-feather="credit-card"></span>
            Заказы</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/shipmentsPanel')!== false) ? 'active' : '' }}" href="{{route('shipmentsPanel')}}">
            <span data-feather="truck"></span>
            Способы доставки</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/couponsPanel')!== false) ? 'active' : '' }}" href="{{route('couponsPanel')}}">
            <span data-feather="gift"></span>
            Купоны</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/specialsPanel')!== false) ? 'active' : '' }}" href="{{route('specialsPanel')}}">
            <span data-feather="percent"></span>
            Акции</a></li>                        
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Добавить</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">      
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/createProductForm')!== false) ? 'active' : '' }}" href="{{route('adminCreateProductForm')}}">
            <span data-feather="plus-circle"></span>
            Добавить товар</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/createCategoryForm')!== false) ? 'active' : '' }}" href="{{route('adminCreateCategoryForm')}}">
            <span data-feather="plus-circle"></span>
            Добавить категорию</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/createBrandForm')!== false) ? 'active' : '' }}" href="{{route('adminCreateBrandForm')}}">
            <span data-feather="plus-circle"></span>
            Добавить бренд</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/createShipmentForm')!== false) ? 'active' : '' }}" href="{{route('adminCreateShipmentForm')}}">
            <span data-feather="plus-circle"></span>
            Добавить способ доставки</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/createCouponForm')!== false) ? 'active' : '' }}" href="{{route('adminCreateCouponForm')}}">
            <span data-feather="plus-circle"></span>
            Добавить купон</a></li>
            <li class="nav-item"><a class="nav-link {{ (strpos(url()->current(), '/admin/createSpecialForm')!== false) ? 'active' : '' }}" href="{{route('adminCreateSpecialForm')}}">
            <span data-feather="plus-circle"></span>
            Добавить акцию</a></li>                                                   
        </ul>        
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Панель администратора</h1>
        @if (strpos(url()->current(), '/admin/products') == false)
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button onclick="window.history.back()" class="btn btn-sm btn-outline-secondary">
              <span data-feather="arrow-left"></span>
              Вернуться на предыдущую страницу
            </button>
            @if(strpos(url()->current(), '/admin/brandsPanel')!== false)
            <a href="{{route('adminCreateBrandForm')}}" class="btn btn-sm btn-outline-secondary">
              <span data-feather="plus-circle"></span>
              Добавить бренд
            </a>
            @endif
            @if(strpos(url()->current(), '/admin/categoriesPanel')!== false)
            <a href="{{route('adminCreateCategoryForm')}}" class="btn btn-sm btn-outline-secondary">
              <span data-feather="plus-circle"></span>
              Добавить категорию
            </a>
            @endif
            @if(strpos(url()->current(), '/admin/shipmentsPanel')!== false)
            <a href="{{route('adminCreateShipmentForm')}}" class="btn btn-sm btn-outline-secondary">
              <span data-feather="plus-circle"></span>
              Добавить способ доставки
            </a>
            @endif
            @if(strpos(url()->current(), '/admin/couponsPanel')!== false)
            <a href="{{route('adminCreateCouponForm')}}" class="btn btn-sm btn-outline-secondary">
              <span data-feather="plus-circle"></span>
              Добавить купон
            </a>
            @endif            
            @if(strpos(url()->current(), '/admin/specialsPanel')!== false)
            <a href="{{route('adminCreateSpecialForm')}}" class="btn btn-sm btn-outline-secondary">
              <span data-feather="plus-circle"></span>
              Добавить акцию
            </a>
            @endif                                                
          </div>
        </div>
        @else
        <a href="{{route('adminCreateProductForm')}}" class="btn btn-sm btn-outline-secondary">
              <span data-feather="plus-circle"></span>
              Добавить товар
        </a>
        @endif        
      </div>
       @yield('body')
    </main>
  </div>
</div>


<script src="{{asset('js/jquery-admin-3.4.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="{{asset ('js/dashboard.js') }}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/bootstrap4.min.js')}}"></script>
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  @yield('ajax')
</script>
</body>
</html>
