<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrees_products', function (Blueprint $table) {
            $table->id();
            $table->integer('entrees_id')->unsigned();

            $table->integer('product_id')->unsigned();

            $table->foreign('entrees_id')->references('id')->on('entrees')

                ->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('products')

                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrees_products');
    }
}
