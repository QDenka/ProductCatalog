<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned(); // Purchase user id, contact info
            $table->bigInteger('cart_id')->index()->unsigned(); // Purchase user id, contact info
            $table->bigInteger('contact_id')->index()->unsigned(); // Contact ID
            $table->float('purchase_amount');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('CASCADE');
            $table->foreign('contact_id')->references('id')->on('contact_info')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
