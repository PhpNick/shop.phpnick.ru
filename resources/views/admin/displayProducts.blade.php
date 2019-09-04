@extends('layouts.admin')

@section('body')

<h2>Все товары</h2>

@if(session('flash'))
<div class="alert alert-warning alert-dismissible fade show" role="alert"> {{session('flash')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#id</th>
            <th>Картинка</th>
            <th>Название</th>
            <th>Короткое описание</th>
            <th>Категория</th>
            <th>Бренд</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Популярный</th>
            <th>Опубликован</th>
            <th>Редактировать картинку</th>
            <th>Редактировать доп. картинки</th>
            <th>Редактировать</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
        <tr>
            <td>{{$product['id']}}</td>
             <td><img src="{{asset ('storage')}}/product_images/{{$product['id']}}/{{$product['image']}}" alt="{{$product['image']}}" width="100"></td>
           <!-- <td>  <img src="{{ Storage::url('product_images/'.$product['image'])}}"
                       alt="<?php echo Storage::url($product['image']); ?>" width="100" height="100" style="max-height:220px" >   </td> -->
            <td>{{$product['name']}}</td>
            <td>{{$product['short_description']}}</td>
            <td>{{$product->category->name}}</td>
            <td>{{$product->brand->name}}</td>
            <td>{{$product['price']}} <i class="fa fa-rub" aria-hidden="true"></i></td>
            <td>{{$product['quantity']}}</td>
            <td>
                <form action="{{ route('adminPopularProduct',['product' => $product->slug ])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <select class="form-control" onchange="submit()" name="popular">
                      <option {{ $product->popular ?'':'selected' }} value="0">Нет</option>
                      <option {{ $product->popular ?'selected':'' }} value="1">Да</option>
                    </select>

                </form>                
            </td>
            <td>
                <form action="{{ route('adminPublishProduct',['product' => $product->slug ])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <select class="form-control" onchange="submit()" name="publish">
                      <option {{ $product->publish ?'':'selected' }} value="0">Нет</option>
                      <option {{ $product->publish ?'selected':'' }} value="1">Да</option>
                    </select>

                </form>                
            </td>
            <td><a href="{{ route('adminEditProductImageForm',['id' => $product['id'] ])}}" class="btn btn-sm btn-outline-secondary">Изменить</a></td>            
            <td><a href="{{ route('adminEditProductImagesForm',['id' => $product['id'] ])}}" class="btn btn-sm btn-outline-secondary">Изменить</a></td>
            <td><a href="{{ route('adminEditProductForm',['id' => $product['id'] ])}}" class="btn btn-sm btn-outline-primary">Редактировать</a></td>
            <td><a onclick="return confirm('Вы уверены?')" href="{{ route('adminDeleteProduct',['id' => $product['id']])}}" class="btn btn-sm btn-warning">Удалить</a></td>


        </tr>

        @endforeach





        </tbody>
    </table>

    {{$products->links('layouts.pagination.admin')}}

</div>
@endsection