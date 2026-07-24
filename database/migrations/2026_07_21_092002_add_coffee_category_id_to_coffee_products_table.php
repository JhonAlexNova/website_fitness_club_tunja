<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoffeeCategoryIdToCoffeeProductsTable extends Migration
{
    public function up()
    {
        Schema::table('coffee_products', function (Blueprint $table) {
            if (!Schema::hasColumn('coffee_products', 'coffee_category_id')) {
                $table->unsignedBigInteger('coffee_category_id')->nullable()->after('id');
            }

            $table->foreign('coffee_category_id')
                ->references('id')->on('coffee_categories')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('coffee_products', function (Blueprint $table) {
            $table->dropForeign(['coffee_category_id']);
            $table->dropColumn('coffee_category_id');
        });
    }
}