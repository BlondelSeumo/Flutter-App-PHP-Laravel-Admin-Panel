<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodOrderExtrasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_order_extras', function (Blueprint $table) {
            $table->integer('food_order_id')->unsigned();
            $table->integer('extra_id')->unsigned();
            $table->double('price', 8, 2)->default(0);
            $table->primary([ 'food_order_id','extra_id']);
            $table->foreign('food_order_id')->references('id')->on('food_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('food_order_extras');
    }
}
