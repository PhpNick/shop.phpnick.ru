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

    <h2>Изменение картинки</h2>

    <h4>Текущая картинка</h4>
    <div><a href="{{asset ('storage')}}/product_images/{{$product['id']}}/{{$product['image']}}" data-lightbox="product-image"><img src="{{asset ('storage')}}/product_images/{{$product['id']}}/{{$product['image']}}" width="100" height="100" style="max-height:220px" ></a></div>

    <form action="{{ route('adminUpdateProductImage',['id' => $product->id ])}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}



        <div class="form-group">
            <label for="description">Изменить картинку</label>
            <input type="file" class=""  name="image" id="image" placeholder="Image" value="{{$product->image}}" required>
        </div>

        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Изменить</button>
    </form>

</div>
@endsection