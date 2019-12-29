<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_messages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type');
            $table->string('status');
            $table->string('message');

            $table->integer('configmessage_id')->unsigned();
            $table->foreign('configmessage_id')->references('id')->on('subscribe_nows');

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
        Schema::dropIfExists('subscription_messages');
    }
}
