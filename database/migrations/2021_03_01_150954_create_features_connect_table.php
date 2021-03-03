<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesConnectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features_connect', function (Blueprint $table) {
            $table->bigInteger('feature_id')->index()->unsigned();
            $table->bigInteger('product_id')->index()->unsigned();
            $table->string('value');
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('CASCADE');
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
        Schema::dropIfExists('features_connect');
    }
}
