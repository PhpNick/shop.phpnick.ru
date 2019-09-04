@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <h2>Редактирование товара</h2>
    <form action="{{ route('adminUpdateProduct',['id' => $product->id ])}}" method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название товара" value="{{$product->name}}" required>
        </div>
        <div class="form-group">
            <label for="slug">Алиас</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Название для ссылки" value="{{$product->slug}}" required>
        </div> 
        <div class="form-group">
            <label for="short-description">Короткое описание</label>
            <input type="text" class="form-control" name="short-description" id="short-description" placeholder="Короткое описание товара" value="{{$product->short_description}}" required>
        </div> 
        <div class="form-group">
            <label for="description">Полное описание</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Полное описание товара" required>{{$product->description}}</textarea>
        </div>        

        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            <label for="category_id" class="">Категория</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @forelse ($categories as $category)
                <option value="{{$category->id}}" {{$category->id == $product->category->id ? 'selected' :''}}>{{$category->name}}</option>
                @empty
                    <option>Пока что здесь ничего нет</option>
                @endforelse
            </select>
        </div>

        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            <label for="brand_id" class="">Бренд</label>
            <select class="form-control" id="brand_id" name="brand_id" required>
                @forelse ($brands as $brand)
                <option value="{{$brand->id}}" {{$brand->id == $product->brand->id ? 'selected' :''}}>{{$brand->name}}</option>
                @empty
                    <option>Пока что здесь ничего нет</option>
                @endforelse
            </select>
        </div>        
        <div class="form-group {{ $errors->has('special_id') ? 'has-error' : '' }}">
            <label for="special_id" class="">Акция</label>
            @if($product->special)
            <select class="form-control" id="special_id" name="special_id">
                <option value="">Без акции</option>
                @foreach ($specials as $special)
                <option value="{{$special->id}}" {{$special->id == $product->special->id ? 'selected' :''}}>{{$special->name}}</option>
                @endforeach
            </select>
            @else
            <select class="form-control" id="special_id" name="special_id">
                <option value="" selected>Без акции</option>
                @foreach ($specials as $special)
                <option value="{{$special->id}}">{{$special->name}}</option>
                @endforeach
            </select>            
            @endif
        </div>
        <div class="form-group">
            <label for="type">Цена</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Цена товара" value="{{$product->price}}" required>
        </div>
        <div class="form-group">
            <label for="type">Количество</label>
            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Количество товара" value="{{$product->quantity}}" required>
        </div>
        <div class="form-group">
            <label for="type">Популярный</label>
            <select class="form-control" name="popular">
              <option value="0" {{ $product->popular ?'':'selected' }}>Нет</option>
              <option value="1" {{ $product->popular ?'selected':'' }}>Да</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Активность</label>
            <select class="form-control" name="publish">
              <option value="0" {{ $product->publish ?'':'selected' }}>Нет</option>
              <option value="1" {{ $product->publish ?'selected':'' }}>Да</option>
            </select>
        </div>                
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Сохранить</button>
    </form>

</div>


@endsection