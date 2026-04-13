<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('fecha_medicion')->default(now());
            $table->string('peso')->nullable();
            $table->string('talla')->nullable();
            $table->string('grasa')->nullable();
            $table->string('musculo')->nullable();
            $table->string('perimetro_abdominal')->nullable();
            $table->decimal('ppm_maximo', 5, 2)->nullable();
            $table->decimal('ppm_minimo', 5, 2)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediciones');
    }
}
