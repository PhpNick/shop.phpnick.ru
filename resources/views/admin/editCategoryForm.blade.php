@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <h2>Редактирование категории</h2>
    <form action="{{route('adminUpdateCategory',['id' => $category->id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название" value="{{$category->name}}" required>
        </div>

        <div class="form-group">
            <label for="slug">Алиас</label>
            <input type=text class="form-control" name="slug" id="slug" placeholder="Алиас" value="{{$category->slug}}" required>
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Описание категории" required>{{$category->description}}</textarea>
        </div>                

        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
    </form>

</div>

@endsection