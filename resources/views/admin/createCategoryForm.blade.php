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


    <h2>Новая категория</h2>

    <form action="{{ route('adminSendCreateCategoryForm')}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            <label for="category_id" class="">Родительская категория</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option>Корневая</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название категории" required>
        </div>
        <div class="form-group">
            <label for="slug">Алиас</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Название для ссылки" required>
        </div> 
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Описание категории" required></textarea>
        </div>                      

        <div class="form-group">
            <label for="image">Картинка</label>
            <input type="file" class=""  name="image" id="image" required>
        </div>
                
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Добавить</button>
    </form>

</div>
@endsection