<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_filename')->nullable();
            $table->string('image_mime')->nullable();
            $table->string('image_original_filename')->nullable();
            $table->string('alter_image_filename')->nullable();
            $table->string('alter_image_mime')->nullable();
            $table->string('alter_image_original_filename')->nullable();
            $table->json('color');
            $table->timestamps();

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
