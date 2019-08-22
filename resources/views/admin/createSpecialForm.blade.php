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

    <h2>Новая акция</h2>

    <form action="{{ route('adminSendCreateSpecialForm')}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название акции" required>
        </div>
        <div class="form-group">
            <label for="type">Тип скидки</label>
            <select class="form-control" name="type">
              <option value="В рублях" selected>В рублях</option>
              <option value="Процентная">Процентная</option>
            </select>
        </div>

        <div class="form-group">
            <label for="discount_amount">Размер скидки</label>
            <div class="input-group">
                <input type="text" class="form-control" name="discount_amount" id="discount_amount" placeholder="0.00" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-rub" aria-hidden="true"></i></span>
                </div>            
            </div>
        </div>
        <div class="form-group">
            <label for="start_date">Начальная дата</label>
            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Начальная дата" value="">
        </div>
        <div class="form-group">
            <label for="end_date">Конечная дата</label>
            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Конечная дата" value="">
        </div>
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Добавить</button>
    </form>

</div>
@endsection