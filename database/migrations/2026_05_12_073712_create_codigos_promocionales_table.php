<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codigos_promocionales', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('creador')->nullable();      // nombre del creador de contenido
            $table->boolean('activo')->default(true);
            $table->integer('usos')->default(0);        // cuántas veces se ha usado
            $table->integer('max_usos')->nullable();    // null = ilimitado
            $table->date('fecha_expiracion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codigos_promocionales');
    }
};