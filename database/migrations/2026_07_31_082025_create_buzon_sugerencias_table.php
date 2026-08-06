<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buzon_sugerencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('tipo', ['problema', 'sugerencia', 'recomendacion', 'pregunta']);
            $table->text('mensaje');
            $table->enum('estado', ['nuevo', 'leido', 'respondido'])->default('nuevo');
            $table->text('respuesta')->nullable();
            $table->timestamp('respondido_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buzon_sugerencias');
    }
};