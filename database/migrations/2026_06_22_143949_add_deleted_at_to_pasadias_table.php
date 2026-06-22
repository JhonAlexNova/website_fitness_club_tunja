<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPasadiasTable extends Migration
{
    public function up()
    {
        Schema::table('pasadias', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('pasadias', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}