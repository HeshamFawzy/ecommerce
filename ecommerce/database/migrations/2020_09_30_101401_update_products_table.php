<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('products', 'materail_id'))

        {

            Schema::table('products', function (Blueprint $table)

            {

                $table->foreign('materail_id')->references('id')->on('materails')->onDelete('cascade');

            });

        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('products', 'materail_id'))

        {

            Schema::table('products', function (Blueprint $table)

            {

                $table->dropColumn('nmaterail_idame');

            });

        }
    }
}
