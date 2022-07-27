<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemppaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temppayments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('trxid');
            $table->integer('amount');
            $table->integer('payment_type');
            $table->string('bulkdata')->nullable();
            $table->integer('tried');
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
        Schema::dropIfExists('temppayments');
    }
}
