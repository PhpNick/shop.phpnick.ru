<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->date("date");
            $table->text("status");
            $table->date("del_date");
            $table->decimal("price",8,2);
            $table->text("fio");
            $table->string('email', 50);
            $table->string('phone', 50);
            $table->text('address');
            $table->text('orderDescription');
            $table->unsignedInteger('user_id');
            $table->string('payment_type', 100);
            $table->unsignedInteger('shipment_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
