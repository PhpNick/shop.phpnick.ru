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

    <h2>Новый купон</h2>

    <form action="{{ route('adminSendCreateCouponForm')}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group">
            <label for="code">Код купона</label>
            <input type="text" class="form-control" name="code" placeholder="Код купона" required>
        </div>
        <div class="form-group">
            <label for="type">Тип</label>
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
            <label for="max_number_of_uses">Максимальное количество использований (пусто - без ограничений)</label>
            <input type="text" class="form-control" name="max_number_of_uses" id="max_number_of_uses" placeholder="">
        </div>                 
        <div class="form-group">
            <label for="start_date">Начальная дата</label>
            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Начальная дата" value="" required>
        </div>
        <div class="form-group">
            <label for="end_date">Конечная дата</label>
            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Конечная дата" value="" required>
        </div>
        <div class="form-group">
            <label for="publish">Активность</label>
            <select class="form-control" name="publish">
              <option value="0">Нет</option>
              <option value="1">Да</option>
            </select>
        </div>                        
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Добавить</button>
    </form>

</div>
@endsection