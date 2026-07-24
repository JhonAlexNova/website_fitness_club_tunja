<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoffeeCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('coffee_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coffee_categories');
    }
}