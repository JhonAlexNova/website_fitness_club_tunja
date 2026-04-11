<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescripcionToEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ejercicios', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->after('nombre_ejercicio');
        });
    }

    public function down()
    {
        Schema::table('ejercicios', function (Blueprint $table) {
            $table->dropColumn('descripcion');
        });
    }
}
