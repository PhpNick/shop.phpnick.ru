<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	public function discount($total) {
        $todayDate = date("Y-m-d");
        if($todayDate < $this->start_date || $todayDate > $this->end_date)
        	return 0;
        if($this->max_number_of_uses === 0 || $this->publish == 0)
        	return 0;
        if($this->max_number_of_uses > 0) {
        	$this->max_number_of_uses--;
        	$this->save();
        }  
        if ($this->type == 'В рублях') {
            return $this->discount_amount;
        } elseif ($this->type == 'Процентная') {
            return round(($this->discount_amount / 100) * $total);
        } else {
            return 0;
        }
    }
}
