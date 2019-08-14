@extends('layouts.admin')

@section('body')

<h2>Все бренды</h2>

@if(session('brandDeletionStatus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert"> {{session('brandDeletionStatus')}}
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
            <th>Алиас</th>
            <th>Описание</th>
            <th>Картинка</th>
            <th>Редактировать картинку</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($brandsAdmin as $brand)  
        <tr>
            <td>{{$brand->id}}</td>
            <td>{{$brand->name}}</td>
            <td>{{$brand->slug}}</td>
            <td>{{$brand->description}}</td>
            <td><img src="{{asset ('storage')}}/brand_images/{{$brand['image']}}" alt="{{asset('storage')}}/brand_images/{{$brand['image']}}" width="100" height="100" style="max-height:220px" ></td>
            <td><a href="{{ route('adminEditBrandImageForm',['id' => $brand['id'] ])}}" class="btn btn-sm btn-outline-secondary">Изменить</a></td>
            <td><a href="{{ route('adminEditBrandForm',['id' => $brand->id ])}}" class="btn btn-sm btn-outline-primary">Редактировать</a></td>
            <td><a href="{{ route('adminDeleteBrand',['id' => $brand->id ])}}"  
                onclick="return confirm('Вы уверены?')" href="" class="btn btn-sm btn-warning">Удалить</a></td>
        @endforeach
        </tbody>
    </table>

    {{$brandsAdmin->links('layouts.pagination.admin')}}

</div>

@endsection





