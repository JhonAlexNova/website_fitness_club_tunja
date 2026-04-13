<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPpmToMedicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mediciones', function (Blueprint $table) {
            $table->decimal('ppm_maximo', 5, 2)->nullable()->after('perimetro_abdominal');
            $table->decimal('ppm_minimo', 5, 2)->nullable()->after('ppm_maximo');
        });
    }

    public function down()
    {
        Schema::table('mediciones', function (Blueprint $table) {
            $table->dropColumn(['ppm_maximo', 'ppm_minimo']);
        });
    }
}
