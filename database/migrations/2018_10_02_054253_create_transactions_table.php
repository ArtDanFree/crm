<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('chin_id')->unsigned()->index()->nullable();
            $table->foreign('chin_id')->references('id')->on('users');
            $table->integer('underwriter_id')->unsigned()->index()->nullable();
            $table->foreign('underwriter_id')->references('id')->on('users');
            $table->boolean('gave_money')->default(false);
            $table->boolean('signed')->default(false);
            $table->string('money')->nullable();
            $table->string('percent')->nullable();
            $table->string('schema')->nullable();
            $table->string('period')->nullable();
            $table->boolean('add_two_payments')->nullable()->default(false);
            $table->text('waiver_description')->nullable();
            $table->integer('waiver_id')->unsigned()->index()->nullable();
            $table->foreign('waiver_id')->references('id')->on('transaction_waivers');
            $table->integer('client_id')->unsigned()->index()->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('deposit_type_id')->unsigned()->index()->nullable();
            $table->foreign('deposit_type_id')->references('id')->on('deposit_types');
            $table->integer('status_id')->unsigned()->index()->default(1);
            $table->foreign('status_id')->references('id')->on('transaction_statuses');
            $table->string('reception_time')->nullable();
            $table->string('date_of_issue')->nullable();


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
        Schema::dropIfExists('transactions');
    }
}
