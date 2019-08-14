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

    <h2>Новый бренд</h2>

    <form action="{{ route('adminSendCreateBrandForm')}}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Название бренда" required>
        </div>
        <div class="form-group">
            <label for="slug">Алиас</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Название для ссылки" required>
        </div> 

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Описание бренда" required></textarea>
        </div>                      

        <div class="form-group">
            <label for="image">Картинка</label>
            <input type="file" class=""  name="image" id="image" required>
        </div>        
                
        <button type="submit" name="submit" class="btn btn-sm btn-outline-primary">Добавить</button>
    </form>

</div>
@endsection