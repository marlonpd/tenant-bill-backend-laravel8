<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->references('id')->on('tenants'); 
            $table->double('rate', 8, 2);
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
        Schema::table('power_rates', function (Blueprint $table) {
            Schema::dropIfExists('power_rates');
        });
    }
}