@extends('layouts.admin')

@section('body')
<style>
    /* The payment window */
  .payment-window {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  /* payment window content */
  .payment-window-content {
    background-color: #fefefe;
    margin: auto;
    padding: 30px;
    border: 1px solid #888;
    width: 45%;
  }
  
  /*  payment window close button */
  .payment-window-close {
    color: #aaaaaa;
    float:right;
    margin-left:20px;
    font-size: 28px;
    font-weight: bold;
  }
  
  
  .payment-window-close:hover,
  .payment-window-close:focus {
    color: #aaaaaa;
    text-decoration: none;
    cursor: pointer;
  }
</style>

<h2>Все заказы</h2>

@if(session('orderDeletionStatus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert"> {{session('orderDeletionStatus')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№ заказа</th>
            <th>Дата заказа</th>
            <th>Дата доставки</th>
            <th>Стоимость</th>
            <th>Пользователь</th>
            <th>Тип оплаты</th>
            <th>Способ доставки</th>
            <th>Статус оплаты</th>
            <th>Информация об оплате</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)  
        <tr>
            <td>{{$order->order_id}}</td>
            <td>{{Carbon\Carbon::parse($order->date)->format('d.m.Y')}}</td>
            <td>{{Carbon\Carbon::parse($order->del_date)->format('d.m.Y')}}</td>
            <td>{{$order->price}}</td>
            <td>
                @if($order->user)
                {{$order->user->name}}
                @else
                Гость
                @endif
            </td>
            <td>{{$order->payment_type}}</td>
            <td>
                @if($order->shipment)
                {{$order->shipment->name}}
                @else
                Способ доставки неопределен
                @endif
            </td>
            <td>{{$order->status}}</td>
            <td>
              <a class="payment-info-button btn btn-sm btn-outline-success" onclick="getPaymentInfo('{{$order->order_id}}', '{{$order->status}}')">Показать</a>
            </td>

            <td><a href="{{ route('adminEditOrderForm',['order_id' => $order->order_id ])}}" class="btn btn-sm btn-outline-primary">Редактировать</a></td>

            <td><a href="{{ route('adminDeleteOrder',['id' => $order->order_id ])}}"  
                onclick="return confirm('Вы уверены?')" href="" class="btn btn-sm btn-warning">Удалить</a></td>
        </tr>

        @endforeach
        </tbody>
    </table>

    <!-- The payment window -->
    <div id="my-payment-window" class="payment-window">
    
      <!-- status content -->
      <div class="payment-window-content">
        <span class="payment-window-close" onclick="hidePaymentInfo()">&times;</span>
        <h2>Данные об оплате</h2>
        <p>Загрузка..</p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
     
      </div>
    
    </div>

    {{$orders->links('layouts.pagination.admin')}}

</div>

    @section('ajax')
    @parent
    function getPaymentInfo(order_id,status){

      if(status === 'Оплачен'){

        $.get( "/payment/getPaymentInfoByOrderId/"+order_id, function( data ) {
             
              // alert( "Data Loaded: " + data ); 
               var paymentInfo = JSON.parse(data);
                $( ".payment-window" ).show();
                $( ".payment-window-content p:eq(0)" ).text( "№ заказа: " + paymentInfo.id);
                $( ".payment-window-content p:eq(1)" ).text( "ID оплаты: " + paymentInfo.paypal_payment_id);
                $( ".payment-window-content p:eq(2)" ).text( "ID плательщика: " + paymentInfo.paypal_payer_id);
                $( ".payment-window-content p:eq(3)" ).text( "Сумма оплаты: " + paymentInfo.amount + " руб.");
          
                });
      } else if(status === 'Не оплачен'){

        $(".payment-window").show();
        $( ".payment-window-content p:eq(0)" ).text( "Еще не оплачен");  
        $( ".payment-window-content p:eq(1)" ).text( "");
        $( ".payment-window-content p:eq(2)" ).text( "");
        $( ".payment-window-content p:eq(3)" ).text( "");
        $( ".payment-window-content p:eq(4)" ).text( "");

      }else{

        $( ".payment-window" ).show();
        $( ".payment-window-content p:eq(0)" ).text( "Неопределенный статус");
        $( ".payment-window-content p:eq(1)" ).text( "");
        $( ".payment-window-content p:eq(2)" ).text( "");
        $( ".payment-window-content p:eq(3)" ).text( "");
        $( ".payment-window-content p:eq(4)" ).text( "");
      }  

     }         

    function hidePaymentInfo(){  
      $(".payment-window").hide();
    }

    @endsection

@endsection





