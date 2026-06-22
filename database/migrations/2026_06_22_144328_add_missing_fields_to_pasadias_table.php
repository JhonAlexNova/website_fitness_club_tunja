<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToPasadiasTable extends Migration
{
    public function up()
    {
        Schema::table('pasadias', function (Blueprint $table) {
            if (!Schema::hasColumn('pasadias', 'nombre')) {
                $table->string('nombre', 50)->after('id');
            }
            if (!Schema::hasColumn('pasadias', 'descripcion')) {
                $table->text('descripcion')->nullable()->after('nombre');
            }
            if (!Schema::hasColumn('pasadias', 'costo')) {
                $table->integer('costo')->after('descripcion');
            }
            if (!Schema::hasColumn('pasadias', 'imagen')) {
                $table->string('imagen')->nullable()->after('costo');
            }
        });
    }

    public function down()
    {
        Schema::table('pasadias', function (Blueprint $table) {
            foreach (['nombre', 'descripcion', 'costo', 'imagen'] as $col) {
                if (Schema::hasColumn('pasadias', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
}