<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPasadiasTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('pasadias', 'deleted_at')) {
            Schema::table('pasadias', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('pasadias', 'deleted_at')) {
            Schema::table('pasadias', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
}
