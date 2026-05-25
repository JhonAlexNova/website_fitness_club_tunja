<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelo3dToMusculosTable extends Migration
{
    public function up()
    {
        Schema::table('musculos', function (Blueprint $table) {
            if (!Schema::hasColumn('musculos', 'modelo_3d')) {
                $table->string('modelo_3d')->nullable()->after('imagen');
            }
        });
    }

    public function down()
    {
        Schema::table('musculos', function (Blueprint $table) {
            if (Schema::hasColumn('musculos', 'modelo_3d')) {
                $table->dropColumn('modelo_3d');
            }
        });
    }
}

