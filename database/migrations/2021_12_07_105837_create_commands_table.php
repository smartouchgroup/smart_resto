<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employeeId');
            $table->unsignedBigInteger('dishId');
            $table->integer('restaurantId');
            $table->integer('userId');
            $table->unsignedBigInteger('organizationId');
            $table->boolean('done')->default(false);
            $table->timestamps();

            $table->foreign('employeeId')
            ->references('id')
            ->on('employees')
            ->onDelete('cascade');

            $table->foreign('dishId')
            ->references('id')
            ->on('dishes')
            ->onDelete('cascade');

            $table->foreign('organizationId')
            ->references('id')
            ->on('organizations')
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
        Schema::dropIfExists('commands');
    }
}
