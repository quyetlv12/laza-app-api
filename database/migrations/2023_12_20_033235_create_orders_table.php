<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->timestamps();
            $table->unsignedBigInteger('cart_id');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->enum('paymentMethod' , ['ATM' , 'MOMO' , 'VNPAY' , 'DELIVERY']);
            $table->enum('status' , ['WAITING_COMFIRM' , 'CONFIRM' , 'TRANSPORT' , 'DELIVERING' , 'RECEIVED '])->default('WAITING_COMFIRM');
            
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
};
