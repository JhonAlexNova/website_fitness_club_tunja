<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriaToMusculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('musculos', function (Blueprint $table) {
            $table->string('categoria')->default('cuerpo_superior')->after('nombre');
        });
    }

    public function down()
    {
        Schema::table('musculos', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
}
