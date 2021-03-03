<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryConnectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_connect', function (Blueprint $table) {
            $table->bigInteger('category_id')->index()->unsigned()->references('id')->on('categories')->onDelete('CASCADE');
            $table->bigInteger('product_id')->index()->unsigned()->references('id')->on('products')->onDelete('CASCADE');
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_connect');
    }
}
