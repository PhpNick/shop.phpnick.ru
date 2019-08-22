@extends('layouts.admin')

@section('body')

<h2>Все акции</h2>

@if(session('specialDeletionStatus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert"> {{session('specialDeletionStatus')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id акции</th>
            <th>Название</th>
            <th>Тип</th>
            <th>Размер скидки</th>
            <th>Начальная дата</th>
            <th>Конечная дата</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($specialsAdmin as $special)  
        <tr>
            <td>{{$special->id}}</td>
            <td>{{$special->name}}</td>
            <td>{{$special->type}}</td>
            <td>{{$special->discount_amount}}</td>
            <td>
                @if($special->start_date === null)
                Не установлена
                @else
                {{Carbon\Carbon::parse($special->start_date)->format('d.m.Y')}}
                @endif
            </td>
            <td>
                @if($special->end_date === null)
                Не установлена
                @else                
                {{Carbon\Carbon::parse($special->end_date)->format('d.m.Y')}}
                @endif
            </td>
            <td><a href="{{ route('adminEditSpecialForm',['special_id' => $special->id ])}}" class="btn btn-sm btn-outline-primary">Редактировать</a></td>

            <td><a href="{{ route('adminDeleteSpecial',['id' => $special->id ])}}"  
                onclick="return confirm('Вы уверены?')" href="" class="btn btn-sm btn-warning">Удалить</a></td>
        </tr>

        @endforeach
        </tbody>
    </table>

    {{$specialsAdmin->links('layouts.pagination.admin')}}

</div>

@endsection





