@extends('layouts.admin')

@section('body')

<h2>Все купоны</h2>

@if(session('couponDeletionStatus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert"> {{session('couponDeletionStatus')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id купона</th>
            <th>Код</th>
            <th>Тип</th>
            <th>Размер скидки</th>
            <th>Количество использований</th>
            <th>Начальная дата</th>
            <th>Конечная дата</th>
            <th>Активность</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($coupons as $coupon)  
        <tr>
            <td>{{$coupon->id}}</td>
            <td>{{$coupon->code}}</td>
            <td>{{$coupon->type}}</td>
            <td>{{$coupon->discount_amount}}</td>
            <td>
                @if($coupon->max_number_of_uses === null)
                Бесконечное количество
                @else
                {{$coupon->max_number_of_uses}}
                @endif
            </td>
            <td>{{Carbon\Carbon::parse($coupon->start_date)->format('d.m.Y')}}</td>
            <td>{{Carbon\Carbon::parse($coupon->end_date)->format('d.m.Y')}}</td>
            <td>
                <form action="{{ route('adminPublishCoupon',['coupon' => $coupon->id ])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <select class="form-control" onchange="submit()" name="publish">
                      <option {{ $coupon->publish ?'':'selected' }} value="0">Нет</option>
                      <option {{ $coupon->publish ?'selected':'' }} value="1">Да</option>
                    </select>

                </form>                
            </td>
            <td><a href="{{ route('adminEditCouponForm',['coupon_id' => $coupon->id ])}}" class="btn btn-sm btn-outline-primary">Редактировать</a></td>

            <td><a href="{{ route('adminDeleteCoupon',['id' => $coupon->id ])}}"  
                onclick="return confirm('Вы уверены?')" href="" class="btn btn-sm btn-warning">Удалить</a></td>
        </tr>

        @endforeach
        </tbody>
    </table>

    {{$coupons->links('layouts.pagination.admin')}}

</div>

@endsection





