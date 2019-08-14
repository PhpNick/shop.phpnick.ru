@extends('layouts.admin')

@section('body')


<div class="table-responsive">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>

            <li>{!! print_r($errors->all()) !!}</li>

        </ul>
    </div>
    @endif

    <h2>Новый способ доставки</h2>

    <form action="{{ route('adminSendCreateShipmentForm')}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" placeholder="Название" required>
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Стоимость доставки" required>
        </div> 
                
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Добавить</button>
    </form>

</div>
@endsection