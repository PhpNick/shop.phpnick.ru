@extends('layouts.index')
@section('title', 'Личный кабинет')
@section('center')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{route('allProducts')}}">Каталог</a></li>
                <li class="active">Личный кабинет</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-4">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
            <p>Имя пользователя: {!! Auth::user()->name !!}</p>
            <p>Почта: {!! Auth::user()->email !!}</p>
        <section id="do_action">
        <div class="container">
            <a href="{{ route('allProducts')}}"  class="btn btn-primary">Вернуться к каталогу</a>
            <a href="{{ route('logout')}}"  class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
            </form>

            @if($userData->isAdmin())
            <a href="{{ route('adminDisplayProducts')}}" class="btn btn-primary">Панель администратора</a>
            @endif
        </div>
        </section><!--/#do_action-->            
            </div>
        </div> 
        <h3>Заказы пользователя</h3>   
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>№ заказа</th>
                    <th>Дата заказа</th>
                    <th>Стоимость</th>
                    <th>Тип оплаты</th>
                    <th>Способ доставки</th>
                    <th>Статус оплаты</th>
                </tr>
                </thead>
                <tbody>

                @forelse($orders as $order)
                <tr>
                    <td>
                        {{$order->order_id}}
                    </td>
                    <td>
                        {{$order->date}}
                    </td>
                    <td>
                        {{$order->price}}
                    </td>
                    <td>
                        {{$order->payment_type}}
                    </td>
                    <td>
                        @if($order->shipment)
                        {{$order->shipment->name}}
                        @else
                        Статус доставки неопределен
                        @endif
                    </td>
                    <td>
                        {{$order->status}}
                        @if(Session::has('payment_info'))
                        <a href="{{route('showPaymentPage')}}">Оплатить</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center">Заказов пока нет</td></tr>
                @endforelse
                </tbody>
            </table>
    </div>
</section>

@endsection
