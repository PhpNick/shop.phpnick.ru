<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('special_id')->nullable();
            $table->unsignedInteger('quantity');
            $table->string('short_description');
            $table->text('description');
            $table->boolean('popular')->default(0);
            $table->boolean('publish')->default(0); 
            $table->string('image');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });

        // Full Text Index
        DB::statement('ALTER TABLE products ADD FULLTEXT fulltext_index (name, slug, short_description, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
