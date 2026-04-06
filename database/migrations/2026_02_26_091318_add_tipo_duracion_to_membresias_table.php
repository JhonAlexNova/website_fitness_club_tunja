<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoDuracionToMembresiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('membresias')) {
            Schema::create('membresias', function (Blueprint $table) {
                $table->id();
                $table->string('nombre', 100)->nullable();
                $table->text('descripcion')->nullable();
                $table->integer('costo')->default(0);
                $table->integer('duracion')->default(1);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn('membresias', 'nombre')) {
            Schema::table('membresias', function (Blueprint $table) {
                $table->string('nombre', 100)->nullable();
            });
        }

        if (!Schema::hasColumn('membresias', 'descripcion')) {
            Schema::table('membresias', function (Blueprint $table) {
                $table->text('descripcion')->nullable();
            });
        }

        if (!Schema::hasColumn('membresias', 'costo')) {
            Schema::table('membresias', function (Blueprint $table) {
                $table->integer('costo')->default(0);
            });
        }

        if (!Schema::hasColumn('membresias', 'duracion')) {
            Schema::table('membresias', function (Blueprint $table) {
                $table->integer('duracion')->default(1);
            });
        }

        if (!Schema::hasColumn('membresias', 'created_at')) {
            Schema::table('membresias', function (Blueprint $table) {
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('membresias', 'deleted_at')) {
            Schema::table('membresias', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn('membresias', 'tipo_duracion')) {
            if (Schema::hasColumn('membresias', 'duracion')) {
                Schema::table('membresias', function (Blueprint $table) {
                    $table->enum('tipo_duracion', ['dias', 'meses'])->default('meses')->after('duracion');
                });
            } else {
                Schema::table('membresias', function (Blueprint $table) {
                    $table->enum('tipo_duracion', ['dias', 'meses'])->default('meses');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membresias', function (Blueprint $table) {
            $table->dropColumn('tipo_duracion');
        });
    }
}
