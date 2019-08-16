@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <h2>Редактирование купона</h2>
    <form action="{{route('adminUpdateCoupon',['id' => $coupon->id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="code">Код купона</label>
            <input type="text" class="form-control" name="code" placeholder="Код купона" value="{{$coupon->code}}" required>
        </div>
        <div class="form-group">
            <label for="type">Тип</label>
            <select class="form-control" name="type">
              <option value="В рублях" {{ $coupon->type == "В рублях" ??'selected' }}>В рублях</option>
              <option value="Процентная" {{ $coupon->type == "В рублях" ?:'selected' }}>Процентная</option>
            </select>
        </div>

        <div class="form-group">
            <label for="discount_amount">Размер скидки</label>
            <div class="input-group">
                <input type="text" class="form-control" name="discount_amount" id="discount_amount" placeholder="0.00" value="{{$coupon->discount_amount}}" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-rub" aria-hidden="true"></i></span>
                </div>            
            </div>
        </div>
        <div class="form-group">
            <label for="max_number_of_uses">Максимальное количество использований (пусто - без ограничений)</label>
            <input type="text" class="form-control" name="max_number_of_uses" id="max_number_of_uses" placeholder="" value="{{$coupon->max_number_of_uses}}">
        </div>                 
        <div class="form-group">
            <label for="start_date">Начальная дата</label>
            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Начальная дата" value="{{$coupon->start_date}}" required>
        </div>
        <div class="form-group">
            <label for="end_date">Конечная дата</label>
            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Конечная дата" value="{{$coupon->end_date}}" required>
        </div>
        <div class="form-group">
            <label for="type">Активность</label>
            <select class="form-control" name="publish">
              <option value="0" {{ $coupon->publish == 0 ??'selected' }}>Нет</option>
              <option value="1" {{ $coupon->publish == 0?:'selected' }}>Да</option>
            </select>
        </div>               

        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
    </form>

</div>

@endsection