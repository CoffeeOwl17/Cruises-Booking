<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCruisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruises', function (Blueprint $table) {
            $table->string('cruise_id');
            $table->string('cruise');
            $table->float('price');

            $table->primary('cruise_id');
        });

        DB::table('cruises')->insert([
            ['cruise_id' => 'C001', 'cruise' => '6 Night Japan Cruise', 'price' => 3000],
            ['cruise_id' => 'C002', 'cruise' => '7 Night Southeast Asia Cruise', 'price' => 4000],
            ['cruise_id' => 'C003', 'cruise' => '6 Night Malaysia Cruise', 'price' => 5000],
            ['cruise_id' => 'C004', 'cruise' => '7 Night Australia Cruise', 'price' => 6000],
            ['cruise_id' => 'C005', 'cruise' => '3 Night Brazil Cruise', 'price' => 7000]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cruises');
    }
}
