@extends('layouts.admin')

@section('body')

<h2>Все способы доставки</h2>

@if(session('shipmentDeletionStatus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert"> {{session('shipmentDeletionStatus')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#id</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($shipments as $shipment)  
        <tr>
            <td>{{$shipment->id}}</td>
            <td>{{$shipment->name}}</td>
            <td>{{$shipment->price}} <i class="fa fa-rub" aria-hidden="true"></i></td>
            <td><a href="{{ route('adminEditShipmentForm',['id' => $shipment->id ])}}" class="btn btn-sm btn-outline-primary">Редактировать</a></td>
            <td><a href="{{ route('adminDeleteShipment',['id' => $shipment->id ])}}"  
                onclick="return confirm('Вы уверены?')" href="" class="btn btn-sm btn-warning">Удалить</a></td>
        @endforeach
        </tbody>
    </table>

    {{$shipments->links('layouts.pagination.admin')}}

</div>

@endsection





