<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutputtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outputtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('outputtypes')->insert(
          array(
              'name' => 'Single Image'
          )
        );
        DB::table('outputtypes')->insert(
          array(
              'name' => 'Video'
          )
        );
        DB::table('outputtypes')->insert(
          array(
              'name' => 'VR'
          )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outputtypes');
    }
}
