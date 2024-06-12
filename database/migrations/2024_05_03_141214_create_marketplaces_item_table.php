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
        Schema::create('marketplaces_item', function (Blueprint $table) {
            $table->id();
            $table->string('itemName');
            $table->text('itemDescription');
            $table->string('images');
            $table->string('price');
            $table->boolean('featured')->default(false);
            $table->integer('seller_id');
            $table->string('warranty')->nullable();
            $table->string('specials')->nullable();
            $table->string('skins')->nullable();
            $table->string('agents')->nullable();
            $table->string('buddies')->nullable();
            $table->string('rank')->nullable();
            $table->string('level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketplaces_item');
    }
};
