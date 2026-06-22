<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasadiasTable extends Migration
{
    public function up()
    {
        Schema::create('pasadias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->text('descripcion')->nullable();
            $table->integer('costo');
            $table->string('imagen')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasadias');
    }
}