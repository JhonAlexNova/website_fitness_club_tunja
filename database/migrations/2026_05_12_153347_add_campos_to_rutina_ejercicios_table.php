<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rutina_ejercicios', function (Blueprint $table) {
            $table->decimal('peso', 6, 2)->nullable()->after('descanso_segundos');
            $table->text('notas')->nullable()->after('peso');
            $table->unsignedSmallInteger('orden')->default(0)->after('notas');
        });
    }

    public function down(): void
    {
        Schema::table('rutina_ejercicios', function (Blueprint $table) {
            $table->dropColumn(['peso', 'notas', 'orden']);
        });
    }
};