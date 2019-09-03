
@extends('layouts.index')
@section('title', 'Оформление заказа')

@section('center')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{route('allProducts')}}">Каталог</a></li>
                <li><a href="{{route('cartproducts')}}">Корзина</a></li>
                <li class="active">Оформление заказа</li>
            </ol>
        </div>

            <div class="shopper-informations">
                <form action="{{route('createNewOrder')}}" method="post">
                <div class="row">
                    <div class="col-md-6 clearfix">
                        <div class="bill-to">
                            <div class="form-one">
                                <p><i class="fa fa-user" aria-hidden="true"></i> Покупатель</p>


                                    {{csrf_field()}}
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                                    <script>
                                    grecaptcha.ready(function() {
                                    grecaptcha.execute('<?php echo env("CAPTCHA_SITE_KEY"); ?>', {action: 'createNewOrder'})
                                    .then(function(token) {
                                        //console.log(token);
                                        document.getElementById('g-recaptcha-response').value=token;
                                    });
                                    });
                                    </script>

                                    @if(Auth::check())
                                    <div class="form-group">
                                    <label for="fio">ФИО *</label>
                                    <input type="text" name="fio" placeholder="ФИО" required value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group">
                                    <label for="email">E-mail *</label>
                                    <input type="email" name="email" placeholder="Почта" required value="{{Auth::user()->email}}"></div> 
                                    @else
                                    <div class="form-group">
                                    <label for="fio">ФИО *</label>
                                    <input type="text" name="fio" placeholder="ФИО" required>
                                    </div>
                                    <div class="form-group"> 
                                    <input type="email" name="email" placeholder="Почта" required></div>
                                    @endif
                                    
                                    <div class="form-group">
                                    <label for="phone">Телефон (8-xxx-xxx-xxxx) *</label>
                                    <input type="tel" pattern="8-[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" name="phone" id="phone" placeholder="8-xxx-xxx-xxxx" required>
                                    </div>

                                    <div class="form-group">
                                    <label for="address">Адрес доставки *</label> 
                                    <textarea name="address" id="address" required="required" rows="4" placeholder="Область/Населенный пункт/Улица/Дом/Квартира/Индекс"></textarea>
                                    </div>
                                    <div class="form-group">
                                    <label for="orderDescription">Комментарии к заказу</label> 
                                    <textarea name="orderDescription" id="orderDescription" rows="4" placeholder="Комментарии к заказу"></textarea>
                                    </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 clearfix">
                        <div class="bill-to">
                            <div class="form-two">
                                <p><i class="fa fa-car" aria-hidden="true"></i> Способ доставки</p>
                                <select id="shipment_id" name="shipment_id" required>
                                @forelse ($shipments as $shipment)
                                    <option value="{{$shipment->id}}">{{$shipment->name}}</option>
                                @empty
                                    <option>Пока что здесь ничего нет</option>
                                @endforelse
                                </select>
                                <p><i class="fa fa-credit-card" aria-hidden="true"></i> Способ оплаты</p>
                                <select id="payment_type" name="payment_type" required>
                                    <option value="paypal">PayPal/Visa/MasterCard</option>
                                    <option value="cash">Наличные</option>
                                </select>
                                <p><i class="fa fa-gift" aria-hidden="true"></i> Купон на скидку</p>
                                <input type="text" name="coupon_code" id="coupon_code" placeholder="Код купона">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 clearfix">
                        
                    </div>    
                </div>
                <button class="btn btn-default check_out pull-right" type="submit" name="submit" >Перейти к оплате</button>
                </form>                           
            </div>

    </div>
</section> <!--/#cart_items-->


@endsection




