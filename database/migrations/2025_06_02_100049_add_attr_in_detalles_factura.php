<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrInDetallesFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_facturas', function (Blueprint $table) {
            $table->string('membresia_id')->nullable()->after('factura_id');
            $table->string('precio_id')->nullable()->change();
            $table->string('producto_id')->nullable()->change();
            $table->integer('cantidad')->change();
            $table->integer('total')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalles_factura', function (Blueprint $table) {
            //
        });
    }
}
