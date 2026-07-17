<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('notificaciones', function (Blueprint $table) {
            // Las notificaciones de admin no pertenecen a un usuario de la app,
            // por eso user_id pasa a ser opcional.
            $table->unsignedBigInteger('user_id')->nullable()->change();

            $table->string('tipo')->nullable()->after('mensaje'); // pago, factura, transferencia, wompi
            $table->string('referencia_tabla')->nullable()->after('tipo'); // 'facturas' | 'pagos'
            $table->unsignedBigInteger('referencia_id')->nullable()->after('referencia_tabla');
            $table->string('enlace')->nullable()->after('referencia_id'); // ruta directa al registro
            $table->boolean('es_admin')->default(false)->after('enlace'); // true = para el panel admin

            $table->index(['es_admin', 'leida']);
        });
    }

    public function down(): void
    {
        Schema::table('notificaciones', function (Blueprint $table) {
            $table->dropIndex(['es_admin', 'leida']);
            $table->dropColumn(['tipo', 'referencia_tabla', 'referencia_id', 'enlace', 'es_admin']);
        });
    }
};