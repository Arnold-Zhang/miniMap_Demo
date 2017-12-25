<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesToRoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_to_roads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roadId');
            $table->integer('cityId');
            $table->timestamps();
            // $table->foreign('roadId')->references('id')->on('roads');
            // $table->foreign('cityId')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities_to_roads');
    }
}
