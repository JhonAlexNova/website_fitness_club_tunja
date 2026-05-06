<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rutinas_diarias_elite', function (Blueprint $table) {
            if (!Schema::hasColumn('rutinas_diarias_elite', 'titulo')) {
                $table->string('titulo');
            }
            if (!Schema::hasColumn('rutinas_diarias_elite', 'descripcion')) {
                $table->text('descripcion')->nullable();
            }
            if (!Schema::hasColumn('rutinas_diarias_elite', 'dia_semana')) {
                $table->enum('dia_semana', ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado']);
            }
            if (!Schema::hasColumn('rutinas_diarias_elite', 'fecha')) {
                $table->date('fecha');
            }
            if (!Schema::hasColumn('rutinas_diarias_elite', 'video_url')) {
                $table->string('video_url')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('rutinas_diarias_elite', function (Blueprint $table) {
            $table->dropColumn(['titulo','descripcion','dia_semana','fecha','video_url']);
        });
    }
};