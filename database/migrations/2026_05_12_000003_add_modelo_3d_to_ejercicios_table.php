<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelo3dToEjerciciosTable extends Migration
{
    public function up()
    {
        Schema::table('ejercicios', function (Blueprint $table) {
            if (!Schema::hasColumn('ejercicios', 'modelo_3d')) {
                $table->string('modelo_3d')->nullable()->after('video_url');
            }
        });
    }

    public function down()
    {
        Schema::table('ejercicios', function (Blueprint $table) {
            if (Schema::hasColumn('ejercicios', 'modelo_3d')) {
                $table->dropColumn('modelo_3d');
            }
        });
    }
}

