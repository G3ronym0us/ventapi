<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVarietyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variety_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->unsignedBigInteger('variety_id');
            $table->timestamps();

            $table->foreign('variety_id')->references('id')->on('varieties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variety_details');
    }
}
