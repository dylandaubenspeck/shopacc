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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('transactionType')->default(1);
            $table->integer('userId');
            $table->integer('productId')->nullable();
            $table->string('productName')->nullable();
            $table->integer('amount');
            $table->integer('walletBefore');
            $table->integer('walletAfter');
            $table->integer('status')->default(0);
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
