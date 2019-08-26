@extends('layouts.admin')

@section('body')

<h2>Все сообщения формы обратной связи</h2>

@if(session('messageDeletionStatus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert"> {{session('messageDeletionStatus')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif



<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#id</th>
            <th>Название</th>
            <th>Почта</th>
            <th>Заголовок</th>
            <th>Текст сообщения</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>

        @foreach($messages as $message)  
        <tr>
            <td>{{$message->id}}</td>
            <td>{{$message->name}}</td>
            <td>{{$message->email}}</td>
            <td>{{$message->subject}}</td>
            <td>{{$message->subject}}</td>
            <td><a href="{{ route('adminDeleteMessage',['id' => $message->id ])}}"  
                onclick="return confirm('Вы уверены?')" href="" class="btn btn-sm btn-warning">Удалить</a></td>
        @endforeach
        </tbody>
    </table>

    {{$messages->links('layouts.pagination.admin')}}

</div>

@endsection





