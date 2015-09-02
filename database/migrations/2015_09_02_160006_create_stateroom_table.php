<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stateroom', function (Blueprint $table) {
            $table->string('stateroom_id');
            $table->string('stateroom');
            $table->float('price');
            $table->primary('stateroom_id');
        });

        DB::table('stateroom')->insert([
            ['stateroom_id' => 'S001', 'stateroom' => 'Royal', 'price' => 600],
            ['stateroom_id' => 'S002', 'stateroom' => 'Deluxe', 'price' => 500],
            ['stateroom_id' => 'S003', 'stateroom' => 'Grand', 'price' => 400],
            ['stateroom_id' => 'S004', 'stateroom' => 'Junior', 'price' => 300]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stateroom');
    }
}
