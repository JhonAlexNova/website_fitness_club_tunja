<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        $this->addColumnIfMissing('users', 'name', function (Blueprint $table) {
            $table->string('name')->nullable();
        });

        $this->addColumnIfMissing('users', 'username', function (Blueprint $table) {
            $table->string('username')->nullable();
        });

        $this->addColumnIfMissing('users', 'primer_nombre', function (Blueprint $table) {
            $table->string('primer_nombre')->nullable();
        });

        $this->addColumnIfMissing('users', 'segundo_nombre', function (Blueprint $table) {
            $table->string('segundo_nombre')->nullable();
        });

        $this->addColumnIfMissing('users', 'primer_apellido', function (Blueprint $table) {
            $table->string('primer_apellido')->nullable();
        });

        $this->addColumnIfMissing('users', 'segundo_apellido', function (Blueprint $table) {
            $table->string('segundo_apellido')->nullable();
        });

        $this->addColumnIfMissing('users', 'celular', function (Blueprint $table) {
            $table->string('celular')->nullable();
        });

        $this->addColumnIfMissing('users', 'documento', function (Blueprint $table) {
            $table->string('documento')->nullable();
        });

        $this->addColumnIfMissing('users', 'foto_perfil', function (Blueprint $table) {
            $table->string('foto_perfil')->nullable();
        });

        $this->addColumnIfMissing('users', 'estado', function (Blueprint $table) {
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
        });

        $this->addColumnIfMissing('users', 'tipo', function (Blueprint $table) {
            $table->string('tipo', 30)->default('Cliente');
        });

        $this->addColumnIfMissing('users', 'fecha_inscripcion', function (Blueprint $table) {
            $table->date('fecha_inscripcion')->nullable();
        });

        $this->addColumnIfMissing('users', 'talla', function (Blueprint $table) {
            $table->decimal('talla', 8, 2)->nullable();
        });

        $this->addColumnIfMissing('users', 'peso', function (Blueprint $table) {
            $table->decimal('peso', 8, 2)->nullable();
        });

        $this->addColumnIfMissing('users', 'perimetro_abdominal', function (Blueprint $table) {
            $table->decimal('perimetro_abdominal', 8, 2)->nullable();
        });

        $this->addColumnIfMissing('users', 'porcentaje_grasa', function (Blueprint $table) {
            $table->decimal('porcentaje_grasa', 8, 2)->nullable();
        });

        $this->addColumnIfMissing('users', 'porcentaje_musculo', function (Blueprint $table) {
            $table->decimal('porcentaje_musculo', 8, 2)->nullable();
        });

        $this->addColumnIfMissing('users', 'observaciones', function (Blueprint $table) {
            $table->text('observaciones')->nullable();
        });
    }

    public function down(): void
    {
        $columns = [
            'name',
            'username',
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            'segundo_apellido',
            'celular',
            'documento',
            'foto_perfil',
            'estado',
            'tipo',
            'fecha_inscripcion',
            'talla',
            'peso',
            'perimetro_abdominal',
            'porcentaje_grasa',
            'porcentaje_musculo',
            'observaciones',
        ];

        Schema::table('users', function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    private function addColumnIfMissing(string $table, string $column, callable $callback): void
    {
        if (!Schema::hasColumn($table, $column)) {
            Schema::table($table, $callback);
        }
    }
}
