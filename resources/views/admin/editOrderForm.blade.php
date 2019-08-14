@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <h2>Редактирование заказа</h2>
    <form action="{{route('adminUpdateOrder',['order_id' => $order->order_id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="date">Дата</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Дата" value="{{$order->date}}" required>
        </div>
        <div class="form-group">
            <label for="del_date">Дата доставки</label>
            <input type="date" class="form-control" name="del_date" id="del_date" placeholder="Дата доставки" value="{{$order->del_date}}" required>
        </div>


        <div class="form-group">
            <label for="price">Стоимость (в руб.)</label>
            <input type=number step="0.01" class="form-control" name="price" id="price" placeholder="Стоимость" value="{{$order->price}}" required>
        </div>

        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Оплачен" {{ $order->status == 'Оплачен' ?'selected':'' }}>Оплачен</option>
                <option value="Не оплачен" {{ $order->status == 'Не оплачен' ?'selected':'' }}>Не оплачен</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fio">ФИО</label>
            <input type="text" class="form-control" name="fio" id="fio" placeholder="ФИО" value="{{$order->fio}}" required>
        </div>
        <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Почта" value="{{$order->email}}" required>
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="tel" pattern="8-[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" name="phone" id="phone" placeholder="8-xxx-xxx-xxxx" value="{{$order->phone}}" required>
        </div>
        <div class="form-group">
            <label for="address">Адрес доставки</label> 
            <textarea name="address" id="address" class="form-control" required="required" rows="4" placeholder="Область/Населенный пункт/Улица/Дом/Квартира/Индекс">{{$order->address}}</textarea>
        </div>
        <div class="form-group">
            <label for="orderDescription">Комментарии к заказу</label> 
            <textarea class="form-control" name="orderDescription" id="orderDescription" rows="4" placeholder="Комментарии к заказу">{{$order->orderDescription}}</textarea>
        </div>
        <div class="form-group">
            <label for="user_id">id пользователя</label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="id пользователя" value="{{$order->user_id}}" required>
        </div>
        <div class="form-group">
            <label for="payment_type">Тип оплаты</label>
            <select class="form-control" id="payment_type" name="payment_type" required>
                <option value="paypal" {{ $order->payment_type == 'paypal' ?'selected':'' }}>PayPal/Visa/MasterCard</option>
                <option value="cash" {{ $order->payment_type == 'cash' ?'selected':'' }}>Наличные</option>
            </select>
        </div>
        <div class="form-group">
            <label for="shipment_id">Тип оплаты</label>
            <select class="form-control" id="shipment_id" name="shipment_id" required>
                @forelse ($shipmentsGlobal as $type)
                <option value="{{$type->id}}" {{ $order->shipment_id == $type->id ?'selected':'' }}>{{$type->name}}</option>
                @empty
                <option>Пока что здесь ничего нет</option>
                @endforelse
            </select>
        </div>        
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
    </form>

</div>

@endsection