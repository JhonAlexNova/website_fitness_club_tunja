<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicioMusculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio_musculo', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->integer('id', true);

            $table->integer('ejercicio_id');

            $table->unsignedBigInteger('musculo_id');

            $table->boolean('es_principal')->default(false);

            $table->timestamps();

            $table->foreign('ejercicio_id')
                ->references('id')
                ->on('ejercicios')
                ->onDelete('cascade');

            $table->foreign('musculo_id')
                ->references('id')
                ->on('musculos')
                ->onDelete('cascade');
        });
    }
}
