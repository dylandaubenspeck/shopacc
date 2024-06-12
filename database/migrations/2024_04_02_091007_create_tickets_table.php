<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->integer('status');
            $table->string('title');
            $table->string('productId')->nullable();
            $table->string('closeReason')->nullable();
            $table->timestamps();
        });

        Schema::create('tickets_message', function (Blueprint $table) {
            $table->id();
            $table->string('ticketId');
            $table->string('userId')->nullable();
            $table->text('message');
            $table->string('attachments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_message');
        Schema::dropIfExists('tickets');
    }
};
