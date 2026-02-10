<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sms_message_id')->unsigned('sms_messages');
            $table->foreignId('user_id')->unsigned();
            $table->enum('status', ['pendiente', 'enviado', 'fallo'])->default('pendiente');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_deliveries');
    }
}
