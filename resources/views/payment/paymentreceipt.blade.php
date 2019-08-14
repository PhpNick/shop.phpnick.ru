@extends('layouts.index')
@section('title', 'Данные об оплате')

@section('center')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{route('allProducts')}}">Каталог</a></li>
                <li class="active">Данные об оплате</li>
            </ol>
        </div>

        <div class="shopper-informations">
            <div class="row">
        
                <div class="col-sm-12 clearfix" style="margin-bottom:20px">
                    <div class="bill-to">
                        <p>Данные об оплате</p>
                        <div class="form-one">
                            
                            <h1 class="text-center">Спасибо за покупку!</h1>
                            <div class="total_area">
                                <ul>
                                    <li>Заказ №<span>{{$payment_receipt['order_id']}}</span></li>      
                                    <li>ID Покупателя<span>{{$payment_receipt['paypal_payer_id']}}</span></li>
                                    <li>ID Оплаты<span>{{$payment_receipt['paypal_payment_id']}}</span></li>
                                    <li>Сумма<span id="amount">{{$payment_receipt['price']}}</span></li>
                                </ul>
                                <a class="btn btn-default update" href="{{route('allProducts')}}">К каталогу</a>
                                              
                            </div>
       
                        </div>
                        <div class="form-two">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section> <!--/#payment-->
@endsection