<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('restaurantId');
            $table->string('picture1');
            $table->string('picture2')->nullable();
            $table->string('picture3')->nullable();
            $table->timestamps();

            $table->foreign('categoryId')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
            $table->foreign('restaurantId')
            ->references('id')
            ->on('restaurants')
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
        Schema::dropIfExists('dishes');
    }
}
