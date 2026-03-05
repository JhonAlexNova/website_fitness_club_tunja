<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenToMusculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('musculos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('nombre');
        });
    }

    public function down()
    {
        Schema::table('musculos', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
}
