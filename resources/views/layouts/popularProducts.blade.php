@if(count($popularProducts))
<div class="recommended_items"><!--popular_items-->
<h2 class="title text-center">Популярные товары</h2>

<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @forelse($popularProducts as $product)
            @if($loop->first)
            <div class="item active">
            @elseif($loop->index%4==0)
            </div>
            <div class="item">    
            @endif
            <div class="col-sm-3">
            <div class="product-image-wrapper">
            <div class="single-products">
            <div class="productinfo  text-center">
                <img src="{{asset ('storage')}}/product_images/{{$product['image']}}" alt="" />
                <h2>
                    <a href="{{route('productDetailsPage',['product'=>$product->slug])}}">{{$product->name}}</a>
                    </h2>
                {{$product->price}} <i class="fa fa-rub" aria-hidden="true"></i>
                <p>{{$product->category->name}} ({{$product->brand->name}})</p>
                <a id="ajaxCartItemPopular{{$product->id}}" href="{{route('AddToCartProduct',['id'=>$product->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину
                </a>
                @section('ajax')
                @parent
                $('#ajaxCartItemPopular{{$product->id}}').click(function(e){
                    e.preventDefault();
                    var stringId = e.target.id,
                        prefix = "ajaxCartItemPopular",
                        id = parseInt(stringId.substring(prefix.length), 10);
                    $.ajax({
                       type:'GET',
                       url:"/product/addToCart/"+id,
                       success:function(data){
                          $( ".ajax-cart" ).html('Корзина <span class="badge cart-badge">'+data['1']+'</span>');

                        $("#itemAddedToCart .modal-body").html('<img width="100" style="float: left" src="{{asset ('storage')}}/product_images/{{$product['image']}}" alt="" /><b>Категория: </b>{{$product->category->name}}<br><b>Наименование: </b>{{$product->name}}<br><b>Бренд: </b>{{$product->brand->name}}<br><b>Цена: </b>{{$product->price}}</h3>');
                        $("#itemAddedToCart").modal('show');                                              
                       }
                    });
                  });
                @endsection         
            </div>
            </div>
            </div>
            </div> 
            @empty
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset('images/home/no-image.jpg')}}" alt="" />
                            <h2>Пока что здесь ничего нет</h2>
                            <p>Пока что здесь ничего нет</p>
                        </div>
                    </div>
                </div>
            </div>       
        @endforelse                            
    </div>

</div>
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a>                   
</div><!--/popular_items-->
@endif