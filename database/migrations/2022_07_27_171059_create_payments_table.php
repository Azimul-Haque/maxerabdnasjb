<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('uid');
            $table->integer('payment_status')->unsigned();
            $table->integer('payment_category')->unsigned();
            $table->integer('payment_method')->nullable();
            $table->string('card_type')->nullable();
            $table->string('amount');
            $table->string('bank');
            $table->string('branch');
            $table->string('pay_slip');
            $table->integer('is_archieved')->unsigned();
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
