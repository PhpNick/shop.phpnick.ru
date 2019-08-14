<?php

use Illuminate\Database\Seeder;

class ShipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipments')->insert([
            'name' => 'Доставка курьером (Стоимость: 500 руб.)',
            'price' => 500,
        ]);
        DB::table('shipments')->insert([
            'name' => 'Доставка курьером по области (Стоимость: 2000 руб.)',
            'price' => 2000,
        ]);
		DB::table('shipments')->insert([
            'name' => 'Самовывоз (Стоимость: бесплатно)',
            'price' => 0,
        ]);
		DB::table('shipments')->insert([
            'name' => 'Бесплатная доставка (при сумме покупки от 3000 руб.)',
            'price' => 0,
        ]);                         
    }
}
