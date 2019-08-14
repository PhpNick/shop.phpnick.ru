@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <h2>Редактирование способа доставки</h2>
    <form action="{{route('adminUpdateShipment',['id' => $shipment->id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название" value="{{$shipment->name}}" required>
        </div>

        <div class="form-group">
            <label for="price">Стоимость (в руб.)</label>
            <input type=number step="0.01" class="form-control" name="price" id="price" placeholder="Стоимость" value="{{$shipment->price}}" required>
        </div>        

        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
    </form>

</div>

@endsection