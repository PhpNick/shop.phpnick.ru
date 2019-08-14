@extends('layouts.admin')

@section('body')

<h2>Все категории</h2>

@if(session('categoryDeletionStatus'))
<div class="alert alert-danger"> {{session('categoryDeletionStatus')}} </div>
@endif



<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#id</th>
            <th>Название</th>
            <th>Алиас</th>
            <th>Родительская категория</th>
            <th>Описание</th>
            <th>Картинка</th>
            <th>Редактировать картинку</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($categoriesAdmin as $cat)  
        <tr>
            <td>{{$cat->id}}</td>
            <td>{{$cat->name}}</td>
            <td>{{$cat->slug}}</td>
            @if(!!$cat->parent)
            <td>{{$cat->parent->name}}</td>
            @else
            <td>Корневая</td>
            @endif            
            <td>{{$cat->description}}</td>
            <td><img src="{{asset ('storage')}}/category_images/{{$cat['image']}}" alt="{{asset ('storage')}}/category_images/{{$cat['image']}}" width="100" height="100" style="max-height:220px" ></td>
            <td><a href="{{ route('adminEditCategoryImageForm',['id' => $cat['id'] ])}}" class="btn btn-sm btn-outline-secondary">Изменить</a></td>
            <td><a href="{{ route('adminEditCategoryForm',['id' => $cat['id'] ])}}" class="btn btn-sm btn-outline-primary">Редактировать</a></td>
            <td><a onclick="return confirm('Вы уверены?')" href="{{ route('adminDeleteCategory',['id' => $cat['id']])}}" class="btn btn-sm btn-warning">Удалить</a></td>
        @endforeach
        </tbody>
    </table>

    {{$categoriesAdmin->links('layouts.pagination.admin')}}

</div>

@endsection





