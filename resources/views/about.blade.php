@extends('layouts.index')
@section('title', 'Подробнее о проекте')
@section('center')
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
		        </div><!--/brands_products-->

		        <div class="sidebar-banner text-center"><!--sidebar-banner-->
		            <img src="{{asset('images/home/shipping.jpg')}}" alt="" />
		        </div><!--/sidebar-banner-->

		    </div>
		</div>

		<div class="col-sm-9">
			<div class="blog-post-area">
				<div class="single-blog-post">
					<h3>Подробнее о проекте</h3>
					<div class="post-meta">
						<ul>
							<li><i class="fa fa-user"></i> Николай Старков</li>
							<li><i class="fa fa-clock-o"></i> 12:33</li>
							<li><i class="fa fa-calendar"></i>15/08/2019</li>
						</ul>
					</div>
					<a href="">
						<img src="/images/blog/blog-one.jpg" alt="">
					</a>
<p>Данный проект написан на фреймворке Laravel (версия 5.6) и содержит в себе основной функционал, необходимый для работы типового интернет-магазина.</p>

<p>Всем, кто занимается веб-разработкой и особенно работает (или начинает работать) с фреймворком Laravel исходники данного проекта могут пригодиться в повседневной работе. Также содержимое проекта поможет начинающим разработчикам научиться читать чужой код.</p>

<p>При желании функционал можно с легкостью доработать и использовать для реального веб-магазина.</p>

<p>Реализованный функционал на данный момент:</p>

<ol>
	<li>возможность создавать неограниченное количество категорий и подкатегорий товаров;</li>
	<li>AJAX-фильтрация товаров по категориям, брендам и цене;</li>
	<li>корзина товаров;</li>
	<li>личный кабинет пользователя с историей заказов;</li>
	<li>возможность оплаты товаров с помощью PayPal;</li>
	<li>форма обратной связи;</li>
	<li>купоны и скидочные акции;</li>
	<li>раздел популярных товаров;</li>
	<li>живой полнотекстовый поиск по каталогу товаров;</li>
	<li>защита от спама с помощью reCAPTCHA v3.</li>
</ol>

<p>
	Функционал в футере не реализован.
</p>

<p style="text-align: center"><strong>Исходники проекта можно посмотреть на <a href="https://github.com/PhpNick/shop.phpnick.ru">GitHub-странице</a></strong></p>

				</div>
			</div><!--/blog-post-area-->
		</div>
	
	</div>
</div>
@endsection