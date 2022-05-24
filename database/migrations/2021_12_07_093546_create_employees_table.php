<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('organizationId');
            $table->unsignedBigInteger('groupId');
            $table->integer('identityCode')->nullable();
            $table->boolean('first_login')->default(true);
            $table->timestamps();

            $table->foreign('userId')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('organizationId')
            ->references('id')
            ->on('organizations')
            ->onDelete('cascade');

            $table->foreign('groupId')
            ->references('id')
            ->on('groups')
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
        Schema::dropIfExists('employees');
    }
}
