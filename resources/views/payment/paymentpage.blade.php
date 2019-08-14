@extends('layouts.index')
@section('title', 'Страница оплаты')

@section('center')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{route('allProducts')}}">Каталог</a></li>
                <li class="active">Страница оплаты</li>
            </ol>
        </div>
        <div class="shopper-informations">
            <div class="row">
        
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Счет на оплату</p>
                        <p>Ваш заказ <strong>№{{$payment_info['order_id']}}</strong> от {{$payment_info['date']->format('d.m.Y H:i')}} успешно создан</p>
                        <div class="form-one">

                            <div class="total_area">
                                    <ul>
                
                                        <li>Статус оплаты
                                        @if($payment_info['status'] == 'Не оплачен')

                                         <span>Не оплачено</span>

                                        @endif

                                        </li>
                                        <li>Стоимость доставки<span>{{$payment_info['shipment_price']}} <i class="fa fa-rub" aria-hidden="true"></i></span></li>
                                        <li>Общая стоимость<span>{{$payment_info['price']}} <i class="fa fa-rub" aria-hidden="true"></i></span></li>
                                    </ul>
                                    @if($payment_info['payment_type'] == 'paypal')
                                    <a class="" id="paypal-button" ></a>
                                    @else
                                    <div class="text-center alert alert-success"><i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i> Оплата курьеру при получении товара</div>
                                    @endif
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

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AfmX5EFaDCZcU6ztCrvh3fr0y9bnjlPj7X0g81tMZhcWLPFqfI84l75UZunkhO9pjfoFrsQtHFaCTaf8',
      production: 'YOUR_PRODUCTION_CLIENT_ID'
    },
    // Customize button (optional)
    locale: 'ru_RU',
    style: {
      size: 'responsive',
      color: 'gold',
      shape: 'rect',
      fundingicons: 'true',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: "{{$payment_info['price']}}",
            currency: 'RUB'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Спасибо за покупку!');
        //Точкой прибавляем путь /paymentreceipt/ к адресу
        //Получается полный путь: payment/paymentreceipt/{paymentID}/{payerID}
        window.location = './paymentreceipt/'+data.paymentID+'/'+data.payerID;


       
      });
    }
  }, '#paypal-button');

</script>


