<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriberHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->date('activedate');
            $table->date('closedate')->nullable(true);
            $table->timestamps();

            $table->integer('subscriber_id')->unsigned();
            $table->foreign('subscriber_id')->references('id')->on('subscribers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriber_histories');
    }
}
