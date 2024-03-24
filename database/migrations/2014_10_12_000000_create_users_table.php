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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('status')->default(1);
            $table->boolean('admin')->default(false);
            $table->string('balance')->default(0);
            $table->rememberToken();
            $table->string('discordId')->nullable();
            $table->string('googleId')->nullable();
            $table->string('facebookId')->nullable();
            $table->timestamps();
            $table->dateTime('reward_claimed')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
