<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detalle_facturas', function (Blueprint $table) {
            $table->unsignedBigInteger('pasadia_id')->nullable();
            $table->foreign('pasadia_id')->references('id')->on('pasadias')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('detalle_facturas', function (Blueprint $table) {
            $table->dropForeign(['pasadia_id']);
            $table->dropColumn('pasadia_id');
        });
    }
};
