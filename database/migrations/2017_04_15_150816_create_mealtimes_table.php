<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mealtimes', function (Blueprint $table) {
            $table->increments('id_mealtime');
            $table->string('mealtime_name');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('mealtime_status');
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
        Schema::dropIfExists('mealtimes');
    }
}
