<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport_series')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('number')->nullable();
            $table->string('birthday')->nullable();
            $table->string('issued_by')->nullable();
            $table->string('when_issued')->nullable();
            $table->string('division_code')->nullable();
            $table->string('departament_code')->nullable();
            $table->string('registration_address')->nullable();
            $table->integer('lead_id')->unsigned()->index();
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->string('reception_time')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
