@extends('layouts.index')
@section('title', $product->name)
@section('center')
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
				
				<div class="col-sm-9 padding-right">
					<div id="ajax-catalog" class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<a href="{{asset ('storage')}}/product_images/{{$product['image']}}" data-lightbox="product-image">
								<img src="{{asset ('storage')}}/product_images/{{$product['image']}}" alt="" />
								</a>
							</div>
							<!-- Slider -->
							@if(isset($files))
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								<!-- Wrapper for slides -->
								<div class="carousel-inner">
									@forelse($files as $file)
										@if($loop->first)
									    <div class="item active">
									    @elseif($loop->index%3==0)
									    </div>
									    <div class="item">
									    @endif
									<a href="{{asset('storage')}}/{{substr($file, 7)}}" data-lightbox="product-image"><img src="{{asset('storage')}}/{{substr($file, 7)}}" alt="" width="85"></a>
									@empty
									@endforelse
									</div>
								</div>

							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
							<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
							<i class="fa fa-angle-right"></i>
							</a>
							</div>		
							@endif							
							<!-- /Slider -->
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2>{{$product->name}}</h2>
								<span>
									<span>{{$product->price}} <i class="fa fa-rub" aria-hidden="true"></i></span>
								</span>
								<span>
									<label>Количество:</label>
									<form action="{{route('AddToCartProduct',['id'=>$product->id])}}" method="GET">
										{{ csrf_field() }}
										<input name="quantity" type="text" value="{{ old('quantity', 1) }}" />
										<button type="submit" name="submit" class="btn btn-afefault cart">
										<i class="fa fa-shopping-cart"></i>
										В корзину
				                        @if(request()->session()->has('status'))
										@section('ajax')
                       					@parent
										$("#itemAddedToCart .modal-body").html('<img width="100" style="float: left" src="{{asset ('storage')}}/product_images/{{$product['image']}}" alt="" /><b>Категория: </b>{{$product->category->name}}<br><b>Наименование: </b>{{$product->name}}<br><b>Бренд: </b>{{$product->brand->name}}<br><b>Цена: </b>{{$product->price}}</h3>');
                                        $("#itemAddedToCart").modal('show');						@endsection
				                        @endif
									</button>
									</form>									
								</span>
								<p><b>Количество товара на складе:</b> {{$product->quantity}}</p>
								<p><b>Бренд:</b> {{$product->brand->name}}</p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Подробнее о товаре</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12">
									<p>{{$product->short_description}}</p>
									<p>{{$product->description}}</p>
								</div>
							</div>
						</div>
					</div><!--/category-tab-->
					@include('layouts.popularProducts')
				</div>
			</div>
		</div>
	</section>
@endsection