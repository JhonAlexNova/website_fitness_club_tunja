<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrInEjerciosRutinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('rutina_ejercicios', function (Blueprint $table) {
            $table->renameColumn('id_rutina_ejercicio', 'id');

            $table->string('volumen')->nullable()->after('id_rutina');
            $table->string('intensidad')->nullable()->after('volumen');
            $table->string('frecuencia')->nullable()->after('intensidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rutina_ejercicios', function (Blueprint $table) {
            $table->dropColumn(['volumen', 'intensidad', 'frecuencia']);
        });
    }
}
