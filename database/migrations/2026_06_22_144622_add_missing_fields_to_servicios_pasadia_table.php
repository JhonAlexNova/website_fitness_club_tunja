<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToServiciosPasadiaTable extends Migration
{
    public function up()
    {
        Schema::table('servicios_pasadia', function (Blueprint $table) {
            if (!Schema::hasColumn('servicios_pasadia', 'pasadia_id')) {
                $table->unsignedBigInteger('pasadia_id')->after('id');
            }
            if (!Schema::hasColumn('servicios_pasadia', 'servicio_id')) {
                $table->unsignedBigInteger('servicio_id')->after('pasadia_id');
            }
        });

        Schema::table('servicios_pasadia', function (Blueprint $table) {
            $table->foreign('pasadia_id')->references('id')->on('pasadias')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('servicios_pasadia', function (Blueprint $table) {
            $table->dropForeign(['pasadia_id']);
            $table->dropForeign(['servicio_id']);
            $table->dropColumn(['pasadia_id', 'servicio_id']);
        });
    }
}