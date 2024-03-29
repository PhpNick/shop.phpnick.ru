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


    <h2>Новый товар</h2>

    <form action="{{ route('adminSendCreateProductForm')}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название товара" required>
        </div>
        <div class="form-group">
            <label for="slug">Алиас</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Название для ссылки" required>
        </div>        
        <div class="form-group">
            <label for="short-description">Короткое описание</label>
            <input type="text" class="form-control" name="short-description" id="short-description" placeholder="Короткое описание товара" required>
        </div> 
        <div class="form-group">
            <label for="description">Полное описание</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Полное описание товара" required></textarea>
        </div> 

        <div class="form-group">
            <label for="image">Картинка</label>
            <input type="file" class=""  name="image" id="image" required>
        </div>
        <div class="form-group">
            <label for="image">Дополнительные картинки (для карточки товара)</label>
            <input type="file" class="" name="additional_images[]" id="additional_images" multiple>
        </div>        
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            <label for="category_id" class="">Категория</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @forelse ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @empty
                    <option>Пока что здесь ничего нет</option>
                @endforelse
            </select>
        </div>

        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            <label for="brand_id" class="">Бренд</label>
            <select class="form-control" id="brand_id" name="brand_id" required>
                @forelse ($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
                @empty
                    <option>Пока что здесь ничего нет</option>
                @endforelse
            </select>
        </div>
        <div class="form-group {{ $errors->has('special_id') ? 'has-error' : '' }}">
            <label for="special_id" class="">Акция</label>
            <select class="form-control" id="special_id" name="special_id">
                <option value="">Без акции</option>
                @foreach ($specials as $special)
                <option value="{{$special->id}}">{{$special->name}}</option>
                @endforeach
            </select>
        </div>                           
        <div class="form-group">
            <label for="price">Цена</label>
            <div class="input-group">
                <input type="text" class="form-control" name="price" id="price" placeholder="0.00" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-rub" aria-hidden="true"></i></span>
                </div>            
            </div>
        </div>
        <div class="form-group">
            <label for="quantity">Количество</label>
            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Количество товара" required>
        </div>
        <div class="form-group">
            <label for="popular">Популярный</label>
            <select class="form-control" name="popular">
              <option value="0" selected>Нет</option>
              <option value="1">Да</option>
            </select>
        </div> 
        <div class="form-group">
            <label for="type">Активность</label>
            <select class="form-control" name="publish">
              <option value="0">Нет</option>
              <option value="1">Да</option>
            </select>
        </div>                       
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Добавить</button>
    </form>

</div>
@endsection