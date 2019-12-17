<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentAccountStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_account_statements', function (Blueprint $table) {
            $table->increments('id');
            $table->date('startdate');
            $table->date('closedate');
            $table->string('status');
            $table->float('amount');
            $table->timestamps();

            $table->integer('paymentmethod_id')->unsigned();
            $table->foreign('paymentmethod_id')->references('id')->on('payment_method_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_account_statements');
    }
}
