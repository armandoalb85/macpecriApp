<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_records', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ip');
            $table->string('location');
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
        Schema::dropIfExists('ip_records');
    }
}
