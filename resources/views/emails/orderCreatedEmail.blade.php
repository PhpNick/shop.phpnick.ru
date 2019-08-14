<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавлен новый заказ</title>
</head>
<body>
    <h1>Спасибо за покупку в нашем магазине!</h1>

    <p>
        Ваш заказ <strong>{{$order_id}}</strong> от {{\Carbon\Carbon::now()->format('d.m.Y H:i')}} успешно создан.
    </p>
    <p>
    	Вы можете следить за выполнением своего заказа в <a href="{{route('home')}}"><i class="fa fa-lock"></i>Личном кабинете</a>. Обратите, что для входа в Личный кабинет необходимо зарегистрироваться.  
    </p>
</body>
</html>