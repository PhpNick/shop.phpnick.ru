@extends('layouts.index')
@section('title', 'Каталог')
@section('center')

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Интернет-магазин на Laravel</h2>
                                <p>Реализован основной функционал типового интернет-магазина.</p>
                                <button type="button" class="btn btn-default get" onclick="location.href='/about'">Подробнее</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Адаптивный шаблон</h2>
                                <p>Используемый шаблон неплохо выглядит на разных устройствах. При желании, конечно, можно прикрутить свой шаблон</p>
                                <button type="button" class="btn btn-default get" onclick="location.href='/about'">Подробнее</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Исходники можно посмотреть на GitHub</h2>
                                <p>Исходники проекта, код из которого можно использовать для разработки различных веб-сайтов на Laravel, а также как основу для интернет-магазина</p>
                                <button type="button" class="btn btn-default get" onclick="location.href='/about'">Подробнее</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->   

<div class="container">
    @include('alert')
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Категории</h2>
                    <!-- menu -->
                    <div id="MainMenu">
                        <div class="list-group">
                        @if(count($categoriesMenu))
                        @include ('categoriesMenu.categoriesMenuList', ['collection' => $categoriesMenu[0]])
                        @else
                        <a class="categoryMenuItem list-group-item list-group-item-success">Пока что здесь ничего нет</a> 
                        @endif
                        </div>
                    </div>
                    @section('ajax')
                    @parent
                        $('.categoryMenuItem').click(function(e){
                            e.preventDefault();
                            $.ajax({
                               type:'GET',
                               url:"/products/category/"+e.target.id,
                               success:function(data){
                                  $( "#ajax-catalog" ).html(data);
                               }
                            });
                          });
                    @endsection                      

                    <div class="brands_products"><!--brands_products-->
                        <h2>Бренды</h2>
                        <div>
                            <ul class="nav nav-pills nav-stacked">
                                @forelse($brands as $brand)
                                <li><a class="brand-link" id="{{$brand->slug}}" href="{{ route('allProductsByBrand', $brand->slug) }}"> <span class="pull-right">{{$brand->products_count}}</span>
                                    {{$brand->name}}</a></li>
                                @empty
                                <li><a>Пока что здесь ничего нет</a></li>
                                @endforelse
                            </ul>
                        </div>
                       @section('ajax')
                       @parent
                            $('.brand-link').click(function(e){
                                e.preventDefault();
                                $.ajax({
                                   type:'GET',
                                   url:"/products/brand/"+e.target.id,
                                   success:function(data){
                                      $( "#ajax-catalog" ).html(data);
                                   }
                                });
                              });
                        @endsection                        
                    </div><!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Розничная цена</h2>
                        <div class="text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="20000" data-slider-step="500" data-slider-value="[0,20000]" id="sl2" ><br />
                            <b class="pull-left">0 <i class="fa fa-rub" aria-hidden="true"></i></b> <b class="pull-right">20000 <i class="fa fa-rub" aria-hidden="true"></i></b>
                        </div>
                        @section('ajax')
                        @parent
                            $('#sl2').slider()
                              .on('slideStop', function(ev){
                                //console.log(ev.value);

                                $.ajax({
                                   type:'GET',
                                   url:"{{route('allProductsByPrice')}}",
                                   data:{price:ev.value},
                                   success:function(data){
                                      $( "#ajax-catalog" ).html(data);
                                   }
                                });
                              });
                        @endsection
                    </div><!--/price-range-->

                    <div class="sidebar-banner text-center"><!--sidebar-banner-->
                        <img src="{{asset('images/home/shipping.jpg')}}" alt="" />
                    </div><!--/sidebar-banner-->

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div id="ajax-catalog" class="features_items"><!--features_items-->
                
                @include('layouts.productsList')

                </div><!--features_items-->

                @include('layouts.popularProducts')
            </div>
        </div>
    </div>
</section>
@endsection
