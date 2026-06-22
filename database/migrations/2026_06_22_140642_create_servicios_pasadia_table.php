<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosPasadiaTable extends Migration
{
    public function up()
    {
        Schema::create('servicios_pasadia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasadia_id');
            $table->unsignedBigInteger('servicio_id');
            $table->timestamps();

            $table->foreign('pasadia_id')->references('id')->on('pasadias')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicios_pasadia');
    }
}