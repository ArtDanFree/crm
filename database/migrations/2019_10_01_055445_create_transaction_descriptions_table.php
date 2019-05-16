<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_descriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('transaction_id')->unsigned()->index()->nullable();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->integer('deposit_id')->unsigned()->index()->nullable();
            $table->foreign('deposit_id')->references('id')->on('deposits');
            //Автомобиль и ПТС
            $table->string('VIN')->nullable();
            $table->string('model_ts')->nullable();
            $table->string('object')->nullable();
            $table->string('year_of_manufacture')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('bodywork_number')->nullable();
            $table->string('color')->nullable();
            $table->string('pts_series')->nullable();
            $table->string('pts_number')->nullable();
            $table->string('pts_issued')->nullable();
            $table->string('pts_date_issued')->nullable();
            $table->string('state_number')->nullable();
            //Квартира,дом,земля (общее)
            $table->string('price_market')->nullable();
            $table->string('evaluative_price')->nullable();
            $table->string('appointment')->nullable();
            $table->string('area')->nullable();
            $table->string('address')->nullable();
            $table->string('basis')->nullable();
            $table->string('cadastral_number')->nullable();
            $table->string('ownership_documents')->nullable();
            $table->string('number_ownership_documents')->nullable();
            $table->string('date_ownership_documents')->nullable();
            $table->string('ownership_documents_issued')->nullable();
            $table->string('restriction')->nullable();
            // квартира
            $table->string('floor')->nullable();
            //дом
            $table->string('floors_count')->nullable();
            //поручитель
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('series')->nullable();
            $table->string('number')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('issued')->nullable();
            $table->string('when_issued')->nullable();
            $table->string('department_code')->nullable();
            $table->string('registration_address')->nullable();
            //юр.лицо
            $table->string('legal_entity_name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('legal_address')->nullable();
            $table->string('ogrn')->nullable();
            $table->string('inn')->nullable();
            $table->string('kpp')->nullable();
            $table->string('position_of_representative')->nullable();
            $table->string('basis_of_authority')->nullable();
            $table->string('correspondent_account')->nullable();
            $table->string('bik')->nullable();
            $table->string('bank')->nullable();
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
        Schema::dropIfExists('transaction_descriptions');
    }
}
