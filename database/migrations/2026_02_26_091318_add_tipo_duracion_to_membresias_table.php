<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoDuracionToMembresiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membresias', function (Blueprint $table) {
            $table->enum('tipo_duracion', ['dias', 'meses'])->default('meses')->after('duracion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membresias', function (Blueprint $table) {
            $table->dropColumn('tipo_duracion');
        });
    }
}
