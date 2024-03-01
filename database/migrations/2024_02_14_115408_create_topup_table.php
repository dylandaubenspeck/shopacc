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
        Schema::create('topup', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('amount');
            $table->integer('status')->default(0);
            $table->string('paymentId');
            $table->string('paymentAccount');
            $table->string('paymentNumber');
            $table->string('paymentContent');
            $table->string('paymentBank');
            $table->string('paymentMetadata');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topup');
    }
};
