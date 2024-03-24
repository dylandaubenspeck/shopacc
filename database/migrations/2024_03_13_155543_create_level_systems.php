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
        Schema::create('level_systems', function (Blueprint $table) {
            $table->id();
            $table->integer('levelName');
            $table->integer('expNeeded');
            $table->string('stockName');
            $table->integer('cooldownHours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_systems');
    }
};
