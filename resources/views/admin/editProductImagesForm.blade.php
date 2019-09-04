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

    <h2>Изменение дополнительных картинок (для карточки товара)</h2>

    @if(isset($files))
        <div>
            @forelse($files as $file)
            <a href="{{asset('storage')}}/{{substr($file, 7)}}" data-lightbox="product-image"><img src="{{asset('storage')}}/{{substr($file, 7)}}" alt="" width="85"></a>
            @empty
            @endforelse
            </div>
        </div>
    @endif

    <form action="{{ route('adminUpdateProductImages',['id' => $product->id ])}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}



        <div class="form-group">
            <label for="image">Изменить картинки</label>
            <input type="file" class="" name="additional_images[]" id="additional_images" multiple>
        </div>

        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Изменить</button>
    </form>

</div>
@endsection