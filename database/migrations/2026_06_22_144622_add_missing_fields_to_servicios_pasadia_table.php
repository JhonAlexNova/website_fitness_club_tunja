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
                $table->unsignedBigInteger('pasadia_id');
            }
            if (!Schema::hasColumn('servicios_pasadia', 'servicio_id')) {
                $table->unsignedBigInteger('servicio_id');
            }
        });
    }

    public function down()
    {
        //
    }
}
