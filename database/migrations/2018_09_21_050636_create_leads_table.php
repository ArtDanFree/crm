<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chin_id')->unsigned()->index()->nullable();
            $table->foreign('chin_id')->references('id')->on('users');
            $table->integer('underwriter_id')->unsigned()->index()->nullable();
            $table->foreign('underwriter_id')->references('id')->on('users');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('money')->nullable();
            $table->string('phone')->nullable();
            $table->text('check')->nullable();
            $table->integer('source_id')->unsigned()->index()->nullable();
            $table->foreign('source_id')->references('id')->on('sources');
            $table->integer('status_id')->unsigned()->index()->default(1);
            $table->foreign('status_id')->references('id')->on('lead_statuses');
            $table->integer('city_id')->unsigned()->index()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('deposit_type_id')->unsigned()->index();
            $table->foreign('deposit_type_id')->references('id')->on('deposit_types');
            $table->datetime('taken_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
