<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('dishId');
            $table->unsignedBigInteger('restaurantId');
            $table->unsignedBigInteger('dayId');
            $table->timestamps();

            $table->foreign('restaurantId')
            ->references('id')
            ->on('restaurants')
            ->onDelete('cascade');

            $table->foreign('dayId')
            ->references('id')
            ->on('days')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
