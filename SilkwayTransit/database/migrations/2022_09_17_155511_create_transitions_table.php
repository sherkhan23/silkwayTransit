<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transitions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('station1_id')->unsigned()->nullable();
            $table->foreign('station1_id')
                ->references('id')
                ->on('stations')
                ->onDelete('cascade');

            $table->bigInteger('station2_id')->unsigned()->nullable();

            $table->boolean('arrived1');
            $table->boolean('arrived2');

            $table->time('st1arriveTime');
            $table->time('st1deportTime');
            $table->time('st1actualArriveTime');

            $table->time('st2arriveTime');
            $table->time('st2deportTime');
            $table->time('st2actualArriveTime');

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
        Schema::dropIfExists('transitions');
    }
};
