<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuadresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuadres', function (Blueprint $table) {
            $table->id();
            $table->integer("producto_id")->unsigned();
            $table->integer("cantidad")->unsigned();
            $table->integer("valor")->unsigned();
            $table->enum("tipo",["Perdida","Ganancia"]);
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
        Schema::dropIfExists('descuadres');
    }
}
