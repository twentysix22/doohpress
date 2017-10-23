<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('description')->nullable();
            $table->integer('owner_id');
            $table->integer('city_id');
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('geo_lat');
            $table->string('geo_long');
            $table->integer('frametype_id');
            $table->integer('frameformat_id');
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
        Schema::dropIfExists('frames');
    }
}