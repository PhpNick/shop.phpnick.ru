 @forelse($products as $product)

    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset ('storage')}}/product_images/{{$product['id']}}/{{$product['image']}}" alt="" />
                    <h2>
                        <a href="{{route('productDetailsPage',['product'=>$product->slug])}}">{{$product->name}}</a>
                        </h2>
                    @if($product->special && $product->special->discount() > 0)
                    <strong>{{$product->price - $product->special->discount($product->price)}}</strong> <i class="fa fa-rub" aria-hidden="true"></i>

                    <s>{{$product->price}}</s> <i class="fa fa-rub" aria-hidden="true"></i>
                    @else
                    <strong>{{$product->price}}</strong> <i class="fa fa-rub" aria-hidden="true"></i>
                    @endif
                    <p>{{$product->category->name}} ({{$product->brand->name}})</p>
                    <a href="{{route('AddToCartProduct',['id'=>$product->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину
                    </a>                                    
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        @if($product->special && $product->special->discount() > 0)
                        <h2>{{$product->price - $product->special->discount($product->price)}} <i class="fa fa-rub" aria-hidden="true"></i></h2>
                        
                        <s>{{$product->price}}</s> <i class="fa fa-rub" aria-hidden="true"></i>
                        @else
                        <h2>{{$product->price}} <i class="fa fa-rub" aria-hidden="true"></i></h2>
                        @endif                            
                        <p>{{$product->name}}</p>
                        <a href="{{route('productDetailsPage',['product'=>$product->slug])}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle"></i>Подробнее</a>
                        <a id="ajaxCartItem{{$product->id}}" href="{{route('AddToCartProduct',['id'=>$product->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                       @section('ajax')
                       @parent
                            $('#ajaxCartItem{{$product->id}}').click(function(e){
                                e.preventDefault();
                                var stringId = e.target.id,
                                    prefix = "ajaxCartItem",
                                    id = parseInt(stringId.substring(prefix.length), 10);
                                $.ajax({
                                   type:'GET',
                                   url:"/product/addToCart/"+id,
                                   success:function(data){
                                      $( ".ajax-cart" ).html('<i class="fa fa-shopping-cart"></i> Корзина <span class="badge cart-badge">'+data['1']+'</span>');

$("#itemAddedToCart .modal-body").html('<img width="100" style="float: left; margin-right: 5px" src="{{asset ('storage')}}/product_images/{{$product['id']}}/{{$product['image']}}" alt="" /><b>Категория: </b>{{$product->category->name}}<br><b>Наименование: </b>{{$product->name}}<br><b>Бренд: </b>{{$product->brand->name}}<br><b>Цена: </b>@if($product->special && $product->special->discount() > 0)<strong>{{$product->price - $product->special->discount($product->price)}}</strong> <i class="fa fa-rub" aria-hidden="true"></i> <s>{{$product->price}}</s> <i class="fa fa-rub" aria-hidden="true"></i>@else<strong>{{$product->price}}</strong> <i class="fa fa-rub" aria-hidden="true"></i>@endif');
                                      $("#itemAddedToCart").modal('show');
                                   }
                                });
                              });
                        @endsection                         
                    </div>
                </div>
                @if($product->popular)
                <img src="/images/home/hit.png" class="hit" alt="">
                @endif     
            </div>
        </div>
    </div> 
    @empty
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('images/home/no-image.jpg')}}" alt="" />
                    <h2>Ничего не найдено</h2>
                    <p>Ничего не найдено</p>
                </div>
            </div>
        </div>
    </div>       

    @endforelse

{{$products->links()}}    
