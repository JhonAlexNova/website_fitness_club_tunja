<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesiones_entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rutina');
            $table->unsignedBigInteger('id_user');
            $table->timestamp('iniciada_at')->nullable();
            $table->timestamp('finalizada_at')->nullable();
            $table->unsignedSmallInteger('duracion_minutos')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('series_completadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sesion');
            $table->unsignedBigInteger('id_rutina_ejercicio');
            $table->unsignedTinyInteger('numero_serie');
            $table->unsignedSmallInteger('repeticiones_realizadas')->nullable();
            $table->decimal('peso_utilizado', 6, 2)->nullable();
            $table->boolean('completada')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('series_completadas');
        Schema::dropIfExists('sesiones_entrenamiento');
    }
};