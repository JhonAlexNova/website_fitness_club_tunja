<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasadiaIdStringToDetalleFacturasTable extends Migration
{
    public function up()
    {
        Schema::table('detalle_facturas', function (Blueprint $table) {
            if (!Schema::hasColumn('detalle_facturas', 'pasadia_id')) {
                $table->string('pasadia_id', 255)->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('detalle_facturas', function (Blueprint $table) {
            if (Schema::hasColumn('detalle_facturas', 'pasadia_id')) {
                $table->dropColumn('pasadia_id');
            }
        });
    }
}
