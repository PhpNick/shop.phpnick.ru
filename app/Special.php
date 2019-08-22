<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
	//Число 777 просто для заглушки
    //Чтобы не передавать значение в видах
    //Где выводится цена со скидкой
    public function discount($total = 777) {
        $todayDate = date("Y-m-d");
        if($this->start_date !== null && $todayDate < $this->start_date)
            return 0;
         if($this->end_date !== null && $todayDate > $this->end_date)
        	return 0;
        if ($this->type == 'В рублях') {
            return $this->discount_amount;
        } elseif ($this->type == 'Процентная') {
            return round(($this->discount_amount / 100) * $total);
        } else {
            return 0;
        }
    }
}
