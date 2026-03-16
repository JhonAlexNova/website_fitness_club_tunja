<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenToClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clases', function (Blueprint $table) {
            $table->string('imagen')->nullable();
        });
    }

    public function down()
    {
        Schema::table('clases', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
}
