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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id');
            $table->integer('stars');
            $table->text('comment')->nullable();
            $table->string('images')->nullable();
            $table->boolean('hidden')->default(false);
            $table->boolean('seller_pinned')->default(false);
            $table->boolean('seller_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
