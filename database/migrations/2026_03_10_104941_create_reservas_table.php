<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cliente_id');

            $table->unsignedBigInteger('horario_clase_id');

            $table->enum('tipo_clase', ['unica','recurrente']);

            $table->date('fecha_reserva')->nullable();

            $table->enum('estado', ['Reservada','Cancelada'])->default('Reservada');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
