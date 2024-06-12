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
        Schema::create('thecao', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('seri');
            $table->string('cardNumber');
            $table->integer('amount');
            $table->string('status');
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thecao');
    }
};
