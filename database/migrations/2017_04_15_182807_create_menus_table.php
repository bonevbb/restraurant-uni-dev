<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name');
            $table->text('menu_description');
            $table->decimal('menu_price');
            $table->string('menu_photo')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('stock_qty');
            $table->integer('minimum_qty')->default(1);
            $table->integer('id_mealtime')->nullable();
            $table->boolean('menu_status');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('menus');
    }
}
