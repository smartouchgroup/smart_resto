<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactionTypeId');
            $table->unsignedBigInteger('employeeId');
            $table->integer('amount');
            $table->timestamps();
            
            $table->foreign('transactionTypeId')
            ->references('id')
            ->on('transaction_types')
            ->onDelete('cascade');

            $table->foreign('employeeId')
            ->references('id')
            ->on('employees')
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
        Schema::dropIfExists('transactions');
    }
}
