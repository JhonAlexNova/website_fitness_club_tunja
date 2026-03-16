<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrInTableFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->string('cantidad_puntos')->after("total")->nullable();
            $table->string('valor_puntos')->after("cantidad_puntos")->nullable();
            $table->string('comprobante')->after("valor_puntos")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_facturas', function (Blueprint $table) {
            //
        });
    }
}
