<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_list', function (Blueprint $table) {
            $table->bigInteger('cart_id')->index()->unsigned();
            $table->bigInteger('product_id')->index()->unsigned();
            $table->integer('count');
            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_list');
    }
}
