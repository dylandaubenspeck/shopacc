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
        Schema::table('products', function($table) {
            $table->integer('exp');
            $table->string('stockName');
        });

        Schema::table('users', function($table) {
            $table->integer('exp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function($table) {
            $table->dropColumn('exp');
            $table->dropColumn('stockName');
        });

        Schema::table('users', function($table) {
            $table->dropColumn('exp');
        });
    }
};
