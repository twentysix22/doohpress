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
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('frametype_id');
            $table->string('width');
            $table->string('height');
            $table->string('fps')->nullable();
            $table->string('max_bitrate')->nullable();
            $table->string('image',1000);
            $table->string('thumbnail',1000);
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
