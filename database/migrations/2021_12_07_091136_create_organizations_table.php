<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('background')->nullable();
            $table->text('description')->nullable();
            $table->string('slogan')->nullable();
            $table->string('schedules')->nullable();
            $table->integer('ticketNumber')->default(0);
            $table->integer('ticketPrice')->default(0);
            $table->integer('allowedDishPerDay')->default(0);
            $table->timestamps();

            $table->foreign('userId')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('organizations');
    }
}
