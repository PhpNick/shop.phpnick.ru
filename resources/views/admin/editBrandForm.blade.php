@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <h2>Редактирование бренда</h2>
    <form action="{{route('adminUpdateBrand',['id' => $brand->id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название" value="{{$brand->name}}" required>
        </div>

        <div class="form-group">
            <label for="slug">Алиас</label>
            <input type=text class="form-control" name="slug" id="slug" placeholder="Алиас" value="{{$brand->slug}}" required>
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Описание бренда" required>{{$brand->description}}</textarea>
        </div>                

        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
    </form>

</div>

@endsection