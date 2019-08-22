@extends('layouts.index')
@section('title', 'Корзина')
@section('center')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{route('allProducts')}}">Каталог</a></li>
                <li class="active">Корзина</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Товар</td>
                    <td class="description"></td>
                    <td class="price">Цена</td>
                    <td class="quantity">Количество</td>
                    <td class="total">Сумма</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>

                @foreach($cartItems->items as $item)

                <tr>
                    <td class="cart_product">
                        <a href=""><img src="{{Storage::disk('local')->url('product_images/'.$item['data']['image'])}}"  width="100" alt=""></a>
                    </td>
                    <td class="cart_description" width="500">
                        <h4><a href="{{route('productDetailsPage',['product'=>$item['data']['slug']])}}">{{$item['data']['name']}}</a></h4>
                        <p>Категория: {{$item['data']['category']['name']}} <br>
                        Бренд: {{$item['data']['brand']['name']}} <br>
                    </td>
                    <td class="cart_price">
                        @php
                        $model = \App\Special::find($item['data']['special']['id']);
                        @endphp
                        @if($item['data']['special'] && $model->discount() > 0)
                        <p>{{$item['data']['price'] - $model->discount($item['data']['price'])}}<br><i>(по акции)</i></p>
                        @else
                        <p>{{$item['data']['price']}}</p>
                        @endif
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href="{{ route('IncreaseSingleProduct',['id' => $item['data']['id']]) }}"> + </a>
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">
                            <a class="cart_quantity_down" href="{{ route('DecreaseSingleProduct',['id' => $item['data']['id']]) }}"> - </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">{{$item['totalSinglePrice']}}</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{ route('DeleteItemFromCart',['id' => $item['data']['id']]) }}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>


                @endforeach



                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <a class="btn btn-default check_out pull-right" href="{{route('checkoutProducts')}}">Оформить заказ</a>
    </div>
</section><!--/#do_action-->


@endsection


