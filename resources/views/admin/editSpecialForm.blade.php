@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <h2>Редактирование акции</h2>
    <form action="{{route('adminUpdateSpecial',['id' => $special->id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Название акции</label>
            <input type="text" class="form-control" name="name" placeholder="Название акции" value="{{$special->name}}" required>
        </div>
        <div class="form-group">
            <label for="type">Тип</label>
            <select class="form-control" name="type">
              <option value="В рублях" {{ $special->type == "В рублях" ??'selected' }}>В рублях</option>
              <option value="Процентная" {{ $special->type == "В рублях" ?:'selected' }}>Процентная</option>
            </select>
        </div>

        <div class="form-group">
            <label for="discount_amount">Размер скидки</label>
            <div class="input-group">
                <input type="text" class="form-control" name="discount_amount" id="discount_amount" placeholder="0.00" value="{{$special->discount_amount}}" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-rub" aria-hidden="true"></i></span>
                </div>            
            </div>
        </div>
         <div class="form-group">
            <label for="start_date">Начальная дата</label>
            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Начальная дата" value="{{$special->start_date}}">
        </div>
        <div class="form-group">
            <label for="end_date">Конечная дата</label>
            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Конечная дата" value="{{$special->end_date}}">
        </div>

        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
    </form>

</div>

@endsection