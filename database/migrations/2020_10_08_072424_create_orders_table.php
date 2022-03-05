<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
//            $table->string('first_name')->nullable();
//            $table->string('last_name')->nullable();
//            $table->string('phone')->nullable();
//            $table->string('address_1')->nullable();
//            $table->string('address_2')->nullable();
//            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('person_id')->unsigned()->nullable();
//            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
//            $table->string('zip_code')->nullable();
//            $table->integer('city_id')->unsigned()->nullable();
//            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
//            $table->bigInteger('is_delivery')->default(0);
//            $table->bigInteger('is_takeaway')->default(0);
            $table->string('order_price')->nullable();
            $table->string('order_status')->default('not-active');
            $table->longText('instructions')->nullable();
            $table->bigInteger('quantity')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
