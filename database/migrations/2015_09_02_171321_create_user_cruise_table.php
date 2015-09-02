<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCruiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cruise', function (Blueprint $table) {
            $table->increments('id');
            $table->string('oauthID');
            $table->string('cruise_id');
            $table->string('stateroom_id');
            $table->integer('num_guest');
            $table->integer('num_stateroom');
            $table->timestamps();

            $table->foreign('oauthID')
                    ->references('oauthID')
                    ->on('user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('cruise_id')
                    ->references('cruise_id')
                    ->on('cruises')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('stateroom_id')
                    ->references('stateroom_id')
                    ->on('stateroom')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_cruise');
    }
}
