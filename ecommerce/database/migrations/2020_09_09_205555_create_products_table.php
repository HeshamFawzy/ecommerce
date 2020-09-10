<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name_en', 100);
            $table->string('name_ar', 100);
            $table->float('price');
            $table->boolean('discount');
            $table->string('image_filename')->nullable();
            $table->string('image_mime')->nullable();
            $table->string('image_original_filename')->nullable();
            $table->string('alter_image_filename')->nullable();
            $table->string('alter_image_mime')->nullable();
            $table->string('alter_image_original_filename')->nullable();
            $table->json('colors');
            $table->json('sizes');
            $table->timestamps();

            $table->Integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
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
