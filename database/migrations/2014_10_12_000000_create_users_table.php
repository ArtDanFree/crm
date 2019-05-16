<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('vk')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->integer('utc')->default(7);
            //Паспортные данные:
            $table->string('passport_series')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('birthday')->nullable();
            $table->string('issued_by')->nullable();
            $table->string('when_issued')->nullable();
            $table->string('division_code')->nullable();
            $table->string('registration_address')->nullable();
            //Банковские реквизиты:
            $table->string('bankcard_number')->nullable();
            $table->string('personal_account')->nullable();
            $table->string('corr_account')->nullable();
            $table->string('bik')->nullable();
            $table->string('bank_name')->nullable();
            ///Подсудность договоров:
            $table->string('court')->nullable();
            $table->string('court_address')->nullable();

            $table->string('password');
            $table->string('avatar')->nullable();
            $table->integer('city_id')->unsigned()->index()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
