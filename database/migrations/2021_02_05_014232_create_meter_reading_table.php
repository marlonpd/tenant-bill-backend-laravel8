<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeterReadingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->references('id')->on('tenants'); 
            $table->dateTime('from_date');
            $table->double('present_reading_kwh', 8, 2);
            $table->dateTime('to_date');
            $table->double('previous_reading_kwh', 8, 2);
            $table->double('consumed_kwh', 8, 2);
            $table->double('rate', 8, 2);
            $table->double('bill', 8, 2);
        });
    }   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meter_readings', function (Blueprint $table) { 
            Schema::dropIfExists('meter_readings');
        });
    }
}