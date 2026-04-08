<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioMembresiasTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('usuario_membresias')) {
            return;
        }

        Schema::create('usuario_membresias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('membresia_id')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('estado', 20)->default('activa');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('membresia_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_membresias');
    }
}
