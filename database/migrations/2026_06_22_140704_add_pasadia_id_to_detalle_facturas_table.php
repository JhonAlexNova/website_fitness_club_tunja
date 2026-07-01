<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->unsignedBigInteger('pasadia_id')->nullable()->after('membresia_id');
            $table->foreign('pasadia_id')->references('id')->on('pasadias')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->dropForeign(['pasadia_id']);
            $table->dropColumn('pasadia_id');
        });
    }
};
